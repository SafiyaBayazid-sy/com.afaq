<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InquiryApiController extends Controller
{
    use ApiResponseTrait;

    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:inquiry_categories,id'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'message' => ['required', 'string'],
        ]);

        $customerId = $request->user()?->customerProfile?->id ?? ($validated['customer_id'] ?? null);

        if (! $customerId) {
            return $this->errorResponse('Customer context is required.', 422);
        }

        $inquiry = Inquiry::create([
            'customer_id' => $customerId,
            'category_id' => $validated['category_id'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
            'admin_notes' => null,
        ]);

        return $this->successResponse(
            $inquiry->load('category', 'customer.user'),
            'Inquiry submitted successfully.',
            201
        );
    }
}
