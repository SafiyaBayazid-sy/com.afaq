<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeviceTokenApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * List device tokens registered for the authenticated customer.
     */
    public function index(Request $request): JsonResponse
    {
        $deviceTokens = $request->user()
            ->deviceTokens()
            ->latest()
            ->get()
            ->map(fn (DeviceToken $deviceToken) => $this->serializeDeviceToken($deviceToken))
            ->values();

        return $this->successResponse($deviceTokens, 'Device tokens retrieved successfully.');
    }

    /**
     * Register or refresh a device token used for push notifications.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'token' => ['required', 'string', 'max:255'],
            'platform' => ['required', Rule::in(['ios', 'android'])],
            'device_name' => ['nullable', 'string', 'max:255'],
            'app_version' => ['nullable', 'string', 'max:50'],
        ]);

        $deviceToken = DeviceToken::updateOrCreate(
            ['token' => $validated['token']],
            [
                'user_id' => $request->user()->id,
                'platform' => $validated['platform'],
                'device_name' => $validated['device_name'] ?? null,
                'app_version' => $validated['app_version'] ?? null,
                'last_used_at' => now(),
            ]
        );

        return $this->successResponse($this->serializeDeviceToken($deviceToken), 'Device token saved successfully.', 201);
    }

    /**
     * Delete one of the authenticated customer's registered device tokens.
     */
    public function destroy(Request $request, DeviceToken $deviceToken): JsonResponse
    {
        if ($deviceToken->user_id !== $request->user()->id) {
            return $this->errorResponse('Not allowed.', 403);
        }

        $deviceToken->delete();

        return $this->successResponse(null, 'Device token deleted successfully.');
    }

    protected function serializeDeviceToken(DeviceToken $deviceToken): array
    {
        return [
            'id' => $deviceToken->id,
            'platform' => $deviceToken->platform,
            'device_name' => $deviceToken->device_name,
            'app_version' => $deviceToken->app_version,
            'last_used_at' => $deviceToken->last_used_at?->toDateTimeString(),
            'created_at' => $deviceToken->created_at?->toDateTimeString(),
            'updated_at' => $deviceToken->updated_at?->toDateTimeString(),
        ];
    }
}
