<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'email',
        'address',
        'birthday',
        'password',
        'user_type',
        'email_verified',
        'verification_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
        'email_verified' => 'boolean',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Scopes
    public function scopeCustomers($query)
    {
        return $query->where('user_type', 'customer');
    }

    public function scopeAdmins($query)
    {
        return $query->where('user_type', 'admin');
    }

    public function scopeVerified($query)
    {
        return $query->where('email_verified', true);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->fname . ' ' . ($this->mname ? $this->mname . ' ' : '') . $this->lname;
    }

    public function getIsAdminAttribute()
    {
        return $this->user_type === 'admin';
    }

    public function getIsCustomerAttribute()
    {
        return $this->user_type === 'customer';
    }
}
