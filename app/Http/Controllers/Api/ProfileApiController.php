<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    use ApiResponseTrait;

    /**
     * Return the authenticated customer's profile and linked customer record.
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user()->load('customerProfile');

        return $this->successResponse($this->serializeUser($user), 'Profile retrieved successfully.');
    }

    protected function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'user_type' => $user->user_type,
            'is_active' => (bool) $user->is_active,
            'customer_profile' => $user->customerProfile ? [
                'id' => $user->customerProfile->id,
                'phone' => $user->customerProfile->phone,
                'source' => $user->customerProfile->source,
            ] : null,
        ];
    }
}
