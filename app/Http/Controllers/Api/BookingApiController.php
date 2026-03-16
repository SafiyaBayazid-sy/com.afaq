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

    /**
     * Create a new appointment booking for the authenticated customer.
     */
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
            $this->serializeBooking($booking->load('customer.user')),
            'Booking submitted successfully.',
            201
        );
    }

    protected function serializeBooking(Booking $booking): array
    {
        return [
            'id' => $booking->id,
            'customer_id' => $booking->customer_id,
            'booking_date' => $booking->booking_date,
            'booking_time' => $booking->booking_time,
            'status' => $booking->status,
            'notes' => $booking->notes,
            'admin_notes' => $booking->admin_notes,
            'customer' => $booking->customer ? [
                'id' => $booking->customer->id,
                'full_name' => $booking->customer->full_name,
                'email' => $booking->customer->email,
                'phone' => $booking->customer->phone,
            ] : null,
            'created_at' => $booking->created_at?->toDateTimeString(),
            'updated_at' => $booking->updated_at?->toDateTimeString(),
        ];
    }
}
