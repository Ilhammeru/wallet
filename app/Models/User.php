<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasWallet;
use App\Traits\OberserverTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasWallet, HasRoles, OberserverTrait;

    const ACTIVE = 1;
    const NONACTIVE_PENDING_PAYMENT = 2;
    const NONACTIVE_EXP = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'package_id',
        'email',
        'password',
        'address',
        'phone',
        'phone_code',
        'avatar',
        'subscribe_at',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['avatar_path'];

    public function avatarPath(): Attribute
    {
        $out = asset('icons/no-user.png');
        if (isset($this->attributes['avatar'])) {
            $out = asset('storage/users/' . $this->attributes['id'] . "/" . $this->attributes['avatar']);
        }
        return Attribute::make(
            get: fn() => $out
        );
    }
}
