<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:20', 'unique:customers,phone'],
            'source' => ['nullable', Rule::in(['facebook', 'google_ad', 'snapchat', 'tiktok', 'friend', 'google_search', 'other'])],
        ]);

        $data = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'user_type' => 'customer',
                'is_active' => true,
            ]);

            if (method_exists($user, 'assignRole')) {
                try {
                    $user->assignRole('customer');
                } catch (\Throwable $exception) {
                    report($exception);
                }
            }

            $customer = Customer::create([
                'user_id' => $user->id,
                'phone' => $validated['phone'],
                'source' => $validated['source'] ?? 'other',
            ]);

            $token = $user->createToken('mobile-auth-token', ['*'])->plainTextToken;

            return [
                'user' => $user,
                'customer' => $customer,
                'token' => $token,
            ];
        });

        return $this->successResponse($data, 'Registered successfully.', 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()
            ->where('email', $validated['email'])
            ->where('user_type', 'customer')
            ->where('is_active', true)
            ->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return $this->errorResponse('Invalid credentials.', 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken('mobile-auth-token', ['*'])->plainTextToken;

        return $this->successResponse([
            'user' => $user->load('customerProfile'),
            'token' => $token,
        ], 'Login successful.');
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();

        return $this->successResponse(null, 'Logged out successfully.');
    }
}
