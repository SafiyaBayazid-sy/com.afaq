<?php

namespace App\Http\Middleware;

use App\Models\VisitorTracking;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackMarketingAttribution
{
    private const ATTRIBUTION_COOKIE = 'marketing_attribution';

    private const LAST_VISIT_COOKIE = 'marketing_last_visit';

    private const VISITOR_COOKIE = 'marketing_visitor_id';

    private const COOKIE_TTL_MINUTES = 129600;

    private const DEDUPLICATION_WINDOW_SECONDS = 600;

    private const TRACKED_ROUTE_NAMES = [
        'home',
        'studies',
        'building.strengthening',
        'legal.consultations',
        'projects.index',
        'project.show',
        'about',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $visitorId = $request->cookie(self::VISITOR_COOKIE) ?: (string) Str::uuid();
        $storedAttribution = $this->decodeCookiePayload($request->cookie(self::ATTRIBUTION_COOKIE));
        $attribution = $this->resolveAttribution($request, $storedAttribution);

        $request->attributes->set('marketing.visitor_id', $visitorId);
        $request->attributes->set('marketing.attribution', $attribution);

        $trackedVisit = false;

        if ($this->shouldTrackVisit($request) && ! $this->isDuplicateVisit($request, $attribution)) {
            $trackedVisit = true;

            try {
                VisitorTracking::query()->create([
                    'visitor_id' => $visitorId,
                    'utm_source' => $attribution['utm_source'] ?? null,
                    'utm_medium' => $attribution['utm_medium'] ?? null,
                    'utm_campaign' => $attribution['utm_campaign'] ?? null,
                    'utm_term' => $attribution['utm_term'] ?? null,
                    'utm_content' => $attribution['utm_content'] ?? null,
                    'landing_path' => $request->getPathInfo(),
                    'referrer_url' => $request->headers->get('referer'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'visited_at' => now(),
                ]);
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        $response = $next($request);

        Cookie::queue(
            Cookie::make(
                self::VISITOR_COOKIE,
                $visitorId,
                self::COOKIE_TTL_MINUTES,
            )
        );

        if ($attribution !== []) {
            Cookie::queue(
                Cookie::make(
                    self::ATTRIBUTION_COOKIE,
                    json_encode($attribution, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                    self::COOKIE_TTL_MINUTES,
                )
            );
        }

        if ($trackedVisit) {
            Cookie::queue(
                Cookie::make(
                    self::LAST_VISIT_COOKIE,
                    json_encode([
                        'fingerprint' => $this->fingerprint($request, $attribution),
                        'tracked_at' => now()->toIso8601String(),
                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                    60,
                )
            );
        }

        return $response;
    }

    protected function shouldTrackVisit(Request $request): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        if (in_array($request->header('Purpose'), ['prefetch', 'preview'], true)) {
            return false;
        }

        if ($request->header('X-Moz') === 'prefetch') {
            return false;
        }

        $routeName = $request->route()?->getName();

        return is_string($routeName) && in_array($routeName, self::TRACKED_ROUTE_NAMES, true);
    }

    protected function resolveAttribution(Request $request, array $storedAttribution): array
    {
        $incoming = array_filter([
            'utm_source' => $request->query('utm_source'),
            'utm_medium' => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),
            'utm_term' => $request->query('utm_term'),
            'utm_content' => $request->query('utm_content'),
        ], fn (?string $value) => filled($value));

        if ($incoming === []) {
            return $storedAttribution;
        }

        return [
            ...$storedAttribution,
            ...$incoming,
            'landing_path' => $request->getPathInfo(),
            'attributed_at' => now()->toIso8601String(),
        ];
    }

    protected function isDuplicateVisit(Request $request, array $attribution): bool
    {
        $lastVisit = $this->decodeCookiePayload($request->cookie(self::LAST_VISIT_COOKIE));
        $fingerprint = Arr::get($lastVisit, 'fingerprint');
        $trackedAt = Arr::get($lastVisit, 'tracked_at');

        if (! is_string($fingerprint) || ! is_string($trackedAt)) {
            return false;
        }

        try {
            $lastTrackedAt = Carbon::parse($trackedAt);
        } catch (\Throwable) {
            return false;
        }

        return $fingerprint === $this->fingerprint($request, $attribution)
            && $lastTrackedAt->diffInSeconds(now()) < self::DEDUPLICATION_WINDOW_SECONDS;
    }

    protected function fingerprint(Request $request, array $attribution): string
    {
        return sha1(json_encode([
            'path' => $request->getPathInfo(),
            'utm_source' => $attribution['utm_source'] ?? null,
            'utm_medium' => $attribution['utm_medium'] ?? null,
            'utm_campaign' => $attribution['utm_campaign'] ?? null,
            'utm_term' => $attribution['utm_term'] ?? null,
            'utm_content' => $attribution['utm_content'] ?? null,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    /**
     * @return array<string, mixed>
     */
    protected function decodeCookiePayload(?string $payload): array
    {
        if (! is_string($payload) || blank($payload)) {
            return [];
        }

        $decoded = json_decode($payload, true);

        return is_array($decoded) ? $decoded : [];
    }
}
