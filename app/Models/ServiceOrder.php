<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'order_type',
        'title',
        'status',
        'status_text',
        'authorized_person',
        'agent_phone',
        'owner_phone',
        'description',
        'address',
        'consultation_full_name',
        'consultation_phone_number',
        'consultation_type',
        'question',
        'agent_name',
        'location',
        'report_url',
        'submitted_at',
        'processed_at',
        'completed_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
