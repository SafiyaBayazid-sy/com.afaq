<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    use HasFactory;

    public const TYPES = [
        'text' => 'Text',
        'textarea' => 'Textarea',
        'email' => 'Email',
        'phone' => 'Phone',
        'number' => 'Number',
        'date' => 'Date',
        'select' => 'Select',
        'radio' => 'Radio',
        'checkbox' => 'Checkbox',
        'multi_select' => 'Multi Select',
    ];

    protected $fillable = [
        'form_template_id',
        'label',
        'key',
        'type',
        'placeholder',
        'help_text',
        'options',
        'min_length',
        'max_length',
        'min_value',
        'max_value',
        'is_required',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'is_active' => 'boolean',
        'min_value' => 'float',
        'max_value' => 'float',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(FormTemplate::class, 'form_template_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getNormalizedOptionsAttribute(): array
    {
        if (blank($this->options)) {
            return [];
        }

        if (array_is_list($this->options)) {
            return collect($this->options)
                ->filter(fn ($value) => filled($value))
                ->mapWithKeys(fn ($value) => [(string) $value => (string) $value])
                ->all();
        }

        return collect($this->options)
            ->filter(fn ($label, $value) => filled($value) && filled($label))
            ->mapWithKeys(fn ($label, $value) => [(string) $value => (string) $label])
            ->all();
    }
}

