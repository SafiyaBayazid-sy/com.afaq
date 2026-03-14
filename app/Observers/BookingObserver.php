<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\BookingHistory;
use Illuminate\Support\Arr;

class BookingObserver
{
    public function created(Booking $booking): void
    {
        BookingHistory::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'action' => 'created',
            'new_status' => $booking->status,
            'new_booking_date' => $booking->booking_date,
            'new_booking_time' => $booking->booking_time,
            'notes' => 'Booking created.',
        ]);
    }

    public function updated(Booking $booking): void
    {
        $changes = collect($booking->getChanges())->except('updated_at');

        if ($changes->isEmpty()) {
            return;
        }

        $changedKeys = $changes->keys()->all();
        $oldValues = Arr::only($booking->getOriginal(), $changedKeys);
        $newValues = $changes->all();

        $action = 'updated';
        $notes = 'Booking updated.';

        if (array_key_exists('status', $newValues)) {
            $action = match ($newValues['status']) {
                'upcoming' => 'approved',
                'cancelled' => 'rejected',
                default => 'status_changed',
            };
            $notes = "Status changed from {$oldValues['status']} to {$newValues['status']}.";
        }

        if (array_key_exists('booking_date', $newValues) || array_key_exists('booking_time', $newValues)) {
            $action = 'rescheduled';
            $notes = 'Booking date/time was rescheduled.';
        }

        BookingHistory::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'action' => $action,
            'old_status' => $oldValues['status'] ?? null,
            'new_status' => $newValues['status'] ?? null,
            'old_booking_date' => $oldValues['booking_date'] ?? null,
            'new_booking_date' => $newValues['booking_date'] ?? null,
            'old_booking_time' => $oldValues['booking_time'] ?? null,
            'new_booking_time' => $newValues['booking_time'] ?? null,
            'notes' => $notes,
        ]);
    }
}
