<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    use ApiResponseTrait;

    public function show(Request $request): JsonResponse
    {
        $user = $request->user()->load('customerProfile');

        return $this->successResponse($user, 'Profile retrieved successfully.');
    }
}
