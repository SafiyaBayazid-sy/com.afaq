<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorTracking extends Model
{
    use HasFactory;

    protected $table = 'visitor_tracking';

    protected $fillable = [
        'visitor_id',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'landing_path',
        'referrer_url',
        'ip_address',
        'user_agent',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    // Accessors
    public function getSourceTextAttribute()
    {
        return $this->utm_source ?? 'مباشر';
    }

    public function getMediumTextAttribute()
    {
        return $this->utm_medium ?? 'مباشر';
    }

    public function getCampaignTextAttribute()
    {
        return $this->utm_campaign ?? 'بدون حملة';
    }

    // Scopes
    public function scopeBySource($query, $source)
    {
        return $query->where('utm_source', $source);
    }

    public function scopeByCampaign($query, $campaign)
    {
        return $query->where('utm_campaign', $campaign);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('visited_at', [$startDate, $endDate]);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('visited_at', now()->toDateString());
    }
}
