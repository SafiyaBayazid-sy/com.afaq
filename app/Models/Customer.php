<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'budget',
        'source',
        'phone',
        'preferred_property_type',
        'notes',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->user->name ?? 'غير معروف';
    }

    public function getEmailAttribute()
    {
        return $this->user->email ?? '';
    }

    public function getPhoneAttribute()
    {
        return $this->user->phone ?? '';
    }

    public function getSourceTextAttribute()
    {
        $sources = [
            'facebook' => 'فيسبوك',
            'google_ad' => 'إعلان جوجل',
            'snapchat' => 'سناب شات',
            'tiktok' => 'تيك توك',
            'friend' => 'صديق',
            'google_search' => 'بحث جوجل',
            'other' => 'أخرى',
        ];

        return $sources[$this->source] ?? $this->source;
    }

    public function getFormattedBudgetAttribute()
    {
        return $this->budget ? number_format($this->budget, 2) . ' ريال' : 'غير محدد';
    }

    // Scopes
    public function scopeFromSource($query, $source)
    {
        return $query->where('source', $source);
    }

    public function scopeWithMinBudget($query, $amount)
    {
        return $query->where('budget', '>=', $amount);
    }
}
