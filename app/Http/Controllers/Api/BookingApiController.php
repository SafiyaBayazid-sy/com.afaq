<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingApiController extends Controller
{
    use ApiResponseTrait;

    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string'],
        ]);

        $customerId = $request->user()?->customerProfile?->id ?? ($validated['customer_id'] ?? null);

        if (! $customerId) {
            return $this->errorResponse('Customer context is required.', 422);
        }

        $booking = Booking::create([
            'customer_id' => $customerId,
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'status' => 'upcoming',
            'notes' => $validated['notes'] ?? null,
            'admin_notes' => null,
        ]);

        return $this->successResponse(
            $booking->load('customer.user'),
            'Booking submitted successfully.',
            201
        );
    }
}
