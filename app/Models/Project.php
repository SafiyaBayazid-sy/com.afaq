<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'country',
        'state',
        'city',
        'street',
        'price',
        'project_status',
        'project_type',
        'property_type',
        'map_location',
        'video_url',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // العلاقات
    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(ProjectImage::class)->where('is_main', true);
    }

    // Accessors
    public function getStatusTextAttribute()
    {
        $statuses = [
            'on_hold' => 'معلق',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
        ];
        
        return $statuses[$this->project_status] ?? $this->project_status;
    }

    public function getProjectTypeTextAttribute()
    {
        $types = [
            'renovation' => 'ترميم',
            'construction' => 'بناء جديد',
        ];
        
        return $types[$this->project_type] ?? $this->project_type;
    }

    public function getPropertyTypeTextAttribute()
    {
        $types = [
            'villa' => 'فيلا',
            'building' => 'عمارة',
            'floor' => 'دور',
            'apartment' => 'شقة',
            'land' => 'أرض',
        ];
        
        return $types[$this->property_type] ?? $this->property_type;
    }

    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->street,
            $this->city,
            $this->state,
            $this->country,
        ]);
        
        return implode('، ', $parts);
    }

    public function getFormattedPriceAttribute()
    {
        return $this->price ? number_format($this->price, 2) . ' ريال' : 'غير محدد';
    }

    public function getFirstImageAttribute()
    {
        $image = $this->images()->first();
        return $image ? $image->image_path : null;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('project_status', $status);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('project_type', $type);
    }

    public function scopeByPropertyType($query, $type)
    {
        return $query->where('property_type', $type);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', 'like', "%{$city}%");
    }
}