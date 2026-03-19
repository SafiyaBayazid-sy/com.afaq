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

    /**
     * Register a new customer account and issue a mobile access token.
     */
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

            $token = $user->issueCustomerToken('mobile-auth-token');

            return [
                'user' => $this->serializeUser($user->load('customerProfile')),
                'customer' => $this->serializeCustomer($customer->load('user')),
                'token' => $token,
            ];
        });

        return $this->successResponse($data, 'Registered successfully.', 201);
    }

    /**
     * Authenticate a customer and issue a fresh mobile access token.
     */
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
        $token = $user->issueCustomerToken('mobile-auth-token');

        return $this->successResponse([
            'user' => $this->serializeUser($user->load('customerProfile')),
            'token' => $token,
        ], 'Login successful.');
    }

    /**
     * Revoke the current Sanctum token for the authenticated customer.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();

        return $this->successResponse(null, 'Logged out successfully.');
    }

    protected function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'user_type' => $user->user_type,
            'is_active' => (bool) $user->is_active,
            'customer_profile' => $user->customerProfile
                ? $this->serializeCustomer($user->customerProfile->loadMissing('user'))
                : null,
        ];
    }

    protected function serializeCustomer(Customer $customer): array
    {
        return [
            'id' => $customer->id,
            'user_id' => $customer->user_id,
            'phone' => $customer->phone,
            'source' => $customer->source,
            'full_name' => $customer->full_name,
            'email' => $customer->email,
        ];
    }
}
