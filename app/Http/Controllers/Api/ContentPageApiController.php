<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ContentPageApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * List customer-facing content pages available to the mobile app.
     */
    public function index(): JsonResponse
    {
        $pages = array_values($this->pages());

        return $this->successResponse($pages, 'Content pages retrieved successfully.');
    }

    /**
     * Show a single customer-facing content page by slug.
     */
    public function show(string $slug): JsonResponse
    {
        $page = $this->pages()[$slug] ?? null;

        if (! $page) {
            return $this->errorResponse('Content page not found.', 404);
        }

        return $this->successResponse($page, 'Content page retrieved successfully.');
    }

    protected function pages(): array
    {
        $siteInfo = SettingsService::getSiteInfo();
        $businessStats = SettingsService::getBusinessStats();
        $socialLinks = SettingsService::getSocialLinks();
        $appLinks = SettingsService::getAppLinks();

        return [
            'home' => [
                'slug' => 'home',
                'title' => 'Home',
                'path' => '/',
                'summary' => 'Landing-page content and top-level contact details for the customer app.',
                'sections' => [
                    [
                        'key' => 'hero',
                        'title' => $siteInfo['name'],
                        'description' => $siteInfo['description'],
                    ],
                    [
                        'key' => 'business_stats',
                        'title' => 'Business Stats',
                        'content' => $businessStats,
                    ],
                ],
            ],
            'about' => [
                'slug' => 'about',
                'title' => 'About',
                'path' => '/about',
                'summary' => 'Company overview, mission, and public contact information.',
                'sections' => [
                    [
                        'key' => 'company_overview',
                        'title' => 'About ' . $siteInfo['name'],
                        'description' => $siteInfo['description'],
                    ],
                    [
                        'key' => 'contact',
                        'title' => 'Contact',
                        'content' => [
                            'phone' => $siteInfo['phone'],
                            'email' => $siteInfo['email'],
                            'address' => $siteInfo['address'],
                        ],
                    ],
                ],
            ],
            'studies' => [
                'slug' => 'studies',
                'title' => 'Studies & Research',
                'path' => '/studies',
                'summary' => 'Informational page for studies, research, and downloadable resources.',
                'sections' => [
                    [
                        'key' => 'overview',
                        'title' => 'Studies and Research',
                        'description' => 'Browse studies, research highlights, and supporting resources.',
                    ],
                    [
                        'key' => 'downloads',
                        'title' => 'Downloads',
                        'content' => [
                            'available' => true,
                            'source' => 'frontend_static_content',
                        ],
                    ],
                ],
            ],
            'building-strengthening' => [
                'slug' => 'building-strengthening',
                'title' => 'Building Strengthening',
                'path' => '/building-strengthening',
                'summary' => 'Service page describing strengthening and rehabilitation offerings.',
                'sections' => [
                    [
                        'key' => 'service',
                        'title' => 'Building Strengthening',
                        'description' => 'Information about building strengthening and rehabilitation services.',
                    ],
                ],
            ],
            'legal-consultations' => [
                'slug' => 'legal-consultations',
                'title' => 'Legal Consultations',
                'path' => '/legal-consultations',
                'summary' => 'Legal consultation page with customer-facing contact details.',
                'sections' => [
                    [
                        'key' => 'overview',
                        'title' => 'Legal Consultations',
                        'description' => 'Reach out for legal consultation and property advisory services.',
                    ],
                    [
                        'key' => 'contact',
                        'title' => 'Contact',
                        'content' => [
                            'email' => $siteInfo['email'],
                            'phone' => $siteInfo['phone'],
                        ],
                    ],
                ],
            ],
            'projects' => [
                'slug' => 'projects',
                'title' => 'Projects',
                'path' => '/projects',
                'summary' => 'Project listing page. Use the projects API for live searchable project data.',
                'sections' => [
                    [
                        'key' => 'api_reference',
                        'title' => 'Project Discovery',
                        'content' => [
                            'browse_endpoint' => '/api/v1/projects',
                            'filters_endpoint' => '/api/v1/projects/filters',
                        ],
                    ],
                ],
            ],
            'app-download' => [
                'slug' => 'app-download',
                'title' => 'Download App',
                'path' => null,
                'summary' => 'Mobile app download links and policy URLs.',
                'sections' => [
                    [
                        'key' => 'store_links',
                        'title' => 'Store Links',
                        'content' => $appLinks,
                    ],
                    [
                        'key' => 'social',
                        'title' => 'Social Links',
                        'content' => $socialLinks,
                    ],
                ],
            ],
        ];
    }
}
