<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    public const SOURCES = [
        'mobile_app' => 'Mobile App API',
        'website' => 'Website API',
        'facebook' => 'Facebook Webhook',
        'google' => 'Google Webhook',
        'manual' => 'Manual Entry',
    ];

    public const STATUSES = [
        'new' => 'New',
        'contacted' => 'Contacted',
        'qualified' => 'Qualified',
        'converted' => 'Converted',
        'lost' => 'Lost',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'source',
        'status',
        'assigned_to',
        'customer_id',
        'campaign_id',
        'external_id',
        'notes',
        'metadata',
        'received_at',
        'last_activity_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'received_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(MarketingCampaign::class, 'campaign_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(LeadActivity::class)->latest();
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeBySource($query, string $source)
    {
        return $query->where('source', $source);
    }
}
