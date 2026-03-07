<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'value' => 'string',
    ];

    // Accessors
    public function getTypedValueAttribute()
    {
        switch ($this->type) {
            case 'boolean':
                return filter_var($this->value, FILTER_VALIDATE_BOOLEAN);
            case 'number':
                return is_numeric($this->value) ? (float) $this->value : 0;
            case 'json':
                return json_decode($this->value, true);
            case 'image':
                return $this->value ? asset('storage/' . $this->value) : null;
            default:
                return $this->value;
        }
    }

    public function getValueDisplayAttribute()
    {
        if ($this->type === 'boolean') {
            return $this->typed_value ? 'نعم' : 'لا';
        }
        
        if ($this->type === 'image' && $this->value) {
            return '<img src="' . asset('storage/' . $this->value) . '" width="50">';
        }
        
        return $this->value;
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopePrivate($query)
    {
        return $query->where('is_public', false);
    }

    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }

    // Methods - Static helper للوصول السريع للإعدادات
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }
        
        return $setting->typed_value;
    }

    public static function setValue($key, $value, $type = 'text')
    {
        $setting = self::firstOrNew(['key' => $key]);
        
        if ($type === 'json' && is_array($value)) {
            $value = json_encode($value);
        }
        
        $setting->value = $value;
        $setting->type = $type;
        $setting->save();
        
        return $setting;
    }

    public static function getGroup($group)
    {
        return self::byGroup($group)->get()->mapWithKeys(function ($item) {
            return [$item->key => $item->typed_value];
        });
    }
}