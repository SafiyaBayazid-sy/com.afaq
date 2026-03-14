<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingCampaign extends Model
{
    use HasFactory;

    protected $table = 'marketing_campaigns';

    protected $fillable = [
        'name',
        'platform',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'start_date',
        'end_date',
        'budget',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
    ];

    // العلاقات (يمكن ربطها بجدول التتبع إذا أردت)
    public function visitors()
    {
        return $this->hasMany(VisitorTracking::class, 'utm_campaign', 'utm_campaign');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'campaign_id');
    }

    // Accessors
    public function getPlatformTextAttribute()
    {
        return $this->platform ?? 'غير محدد';
    }

    public function getFormattedBudgetAttribute()
    {
        return $this->budget ? number_format($this->budget, 2) . ' ريال' : 'غير محدد';
    }

    public function getIsActiveAttribute()
    {
        $now = now();
        return $this->start_date <= $now && $this->end_date >= $now;
    }

    public function getDurationAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return 'غير محدد';
        }
        
        $days = $this->start_date->diffInDays($this->end_date);
        return $days . ' يوم';
    }

    // Scopes
    public function scopeActive($query)
    {
        $now = now();
        return $query->where('start_date', '<=', $now)
                     ->where('end_date', '>=', $now);
    }

    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('start_date', [$startDate, $endDate])
                     ->orWhereBetween('end_date', [$startDate, $endDate]);
    }
}
