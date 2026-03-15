<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'target',
        'is_active',
        'success_message',
        'settings',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
        'published_at' => 'datetime',
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($builder) {
                $builder->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
    }
}
