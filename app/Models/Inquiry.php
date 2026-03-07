<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiries';

    protected $fillable = [
        'customer_id',
        'category_id',
        'message',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // العلاقات
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(InquiryCategory::class, 'category_id');
    }

    // Accessors
    public function getStatusTextAttribute()
    {
        $statuses = [
            'new' => 'جديد',
            'contacted' => 'تم التواصل',
            'completed' => 'مكتمل',
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'new' => 'danger',
            'contacted' => 'warning',
            'completed' => 'success',
        ];
        
        return $colors[$this->status] ?? 'secondary';
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer->full_name ?? 'محذوف';
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name ?? 'غير مصنف';
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}