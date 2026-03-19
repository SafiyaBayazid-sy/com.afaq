<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, HasRoles,Notifiable, TwoFactorAuthenticatable;

    public const CUSTOMER_TOKEN_ABILITIES = [
        'customer:auth',
        'customer:profile:read',
        'customer:notifications:read',
        'customer:notifications:update',
        'customer:device-tokens:manage',
        'customer:bookings:create',
        'customer:inquiries:create',
        'customer:orders:create',
        'customer:orders:read',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'two_factor_confirmed_at' => 'datetime',

    ];

    /**
     * Determine if the user can access the Filament panel
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Only admins can access the admin panel
        // Must be active and have user_type = 'admin'
        return $this->is_active && $this->user_type === 'admin';
    }

    // العلاقات
    public function customerProfile()
    {
        return $this->hasOne(Customer::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function assignedLeads()
    {
        return $this->hasMany(Lead::class, 'assigned_to');
    }

    public function leadActivities()
    {
        return $this->hasMany(LeadActivity::class);
    }

    public function bookingHistories()
    {
        return $this->hasMany(BookingHistory::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAdmins($query)
    {
        return $query->where('user_type', 'admin');
    }

    public function scopeCustomers($query)
    {
        return $query->where('user_type', 'customer');
    }

    // Accessors
    public function getIsAdminAttribute()
    {
        return $this->user_type === 'admin';
    }

    public function getIsCustomerAttribute()
    {
        return $this->user_type === 'customer';
    }

    public function getStatusTextAttribute()
    {
        return $this->is_active ? 'نشط' : 'غير نشط';
    }

    // Check if user is admin
    public function isAdmin(): bool
    {
        return $this->user_type === 'admin';
    }

    // Check if user is customer
    public function isCustomer(): bool
    {
        return $this->user_type === 'customer';
    }

    public static function customerTokenAbilities(): array
    {
        return self::CUSTOMER_TOKEN_ABILITIES;
    }

    public function issueCustomerToken(string $tokenName): string
    {
        $expiration = config('sanctum.expiration');
        $expiresAt = filled($expiration) ? now()->addMinutes((int) $expiration) : null;

        return $this->createToken($tokenName, self::customerTokenAbilities(), $expiresAt)->plainTextToken;
    }
}
