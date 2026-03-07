<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryCategory extends Model
{
    use HasFactory;

    protected $table = 'inquiry_categories';

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // العلاقات
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors
    public function getInquiriesCountAttribute()
    {
        return $this->inquiries()->count();
    }
}