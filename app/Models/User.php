<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'publisher_id', 'first_name', 'last_name', 'company', 'email', 'password', 'phone', 'address', 'address2', 'city', 'state', 'zipcode', 'url', 'status', 'logo',
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
     *
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * user has many businesses (one to many relationship)
     */
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    /**
     * user has many keywords (one to many relationship)
     * user means super_admin or user
     */
    public function keywords()
    {
        return $this->hasMany(Keyword::class,'super_admin_user_id');
    }
}
