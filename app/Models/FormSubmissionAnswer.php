<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmissionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_submission_id',
        'form_field_id',
        'field_key',
        'field_label',
        'field_type',
        'answer_text',
        'answer_json',
    ];

    protected $casts = [
        'answer_json' => 'array',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(FormSubmission::class, 'form_submission_id');
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(FormField::class, 'form_field_id');
    }

    public function getDisplayAnswerAttribute(): string
    {
        if (! is_null($this->answer_text)) {
            return $this->answer_text;
        }

        if (is_array($this->answer_json)) {
            return implode(', ', $this->answer_json);
        }

        return '';
    }
}

