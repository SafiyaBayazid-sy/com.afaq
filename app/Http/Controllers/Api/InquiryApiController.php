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

    /**
     * Submit a customer inquiry from the mobile app.
     */
    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:inquiry_categories,id'],
            'message' => ['required', 'string'],
        ]);

        $user = $request->user()?->loadMissing('customerProfile');
        $customerId = $user?->customerProfile?->id;

        if (! $customerId) {
            return $this->errorResponse('Customer account required.', 403);
        }

        $inquiry = Inquiry::create([
            'customer_id' => $customerId,
            'category_id' => $validated['category_id'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
            'admin_notes' => null,
        ]);

        return $this->successResponse(
            $this->serializeInquiry($inquiry->load('category', 'customer.user')),
            'Inquiry submitted successfully.',
            201
        );
    }

    protected function serializeInquiry(Inquiry $inquiry): array
    {
        return [
            'id' => $inquiry->id,
            'customer_id' => $inquiry->customer_id,
            'category_id' => $inquiry->category_id,
            'message' => $inquiry->message,
            'status' => $inquiry->status,
            'admin_notes' => $inquiry->admin_notes,
            'category' => $inquiry->category ? [
                'id' => $inquiry->category->id,
                'name' => $inquiry->category->name,
            ] : null,
            'customer' => $inquiry->customer ? [
                'id' => $inquiry->customer->id,
                'full_name' => $inquiry->customer->full_name,
                'email' => $inquiry->customer->email,
                'phone' => $inquiry->customer->phone,
            ] : null,
            'created_at' => $inquiry->created_at?->toDateTimeString(),
            'updated_at' => $inquiry->updated_at?->toDateTimeString(),
        ];
    }
}
