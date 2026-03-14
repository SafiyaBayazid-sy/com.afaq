<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'action',
        'old_status',
        'new_status',
        'old_booking_date',
        'new_booking_date',
        'old_booking_time',
        'new_booking_time',
        'notes',
    ];

    protected $casts = [
        'old_booking_date' => 'date',
        'new_booking_date' => 'date',
        'old_booking_time' => 'datetime:H:i:s',
        'new_booking_time' => 'datetime:H:i:s',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

