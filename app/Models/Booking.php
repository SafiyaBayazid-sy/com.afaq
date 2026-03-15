<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'customer_id',
        'booking_date',
        'booking_time',
        'status',
        'notes',
        'admin_notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime:H:i:s',
    ];

    // العلاقات
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function histories()
    {
        return $this->hasMany(BookingHistory::class)->latest();
    }

    // Accessors
    public function getStatusTextAttribute()
    {
        $statuses = [
            'upcoming' => 'قادم',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'upcoming' => 'primary',
            'completed' => 'success',
            'cancelled' => 'danger',
        ];
        
        return $colors[$this->status] ?? 'secondary';
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer->full_name ?? 'محذوف';
    }

    public function getFormattedDateTimeAttribute()
    {
        return $this->booking_date->format('Y-m-d') . ' ' . $this->booking_time->format('H:i');
    }

    public function getFormattedDateAttribute()
    {
        return $this->booking_date->format('Y-m-d');
    }

    public function getFormattedTimeAttribute()
    {
        return $this->booking_time->format('H:i');
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
                     ->where('booking_date', '>=', now()->toDateString());
    }

    public function scopeToday($query)
    {
        return $query->whereDate('booking_date', now()->toDateString());
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('booking_date', [$startDate, $endDate]);
    }
}
