<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PublicSettingsApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Return public settings used by the customer mobile app.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            SettingsService::getPublicSettings(),
            'Public settings retrieved successfully.'
        );
    }
}
