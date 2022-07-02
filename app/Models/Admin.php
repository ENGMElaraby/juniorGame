<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static create(array $array)
 */
class Admin extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable, HasFactory, Notifiable;

    const ADMIN = 1;
    const SECRETARY = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $role
     * @return string|null
     */
    public function getRoleAttribute($role): ?string
    {
        return match ($role) {
            self::ADMIN => 'admin',
            self::SECRETARY => 'secretary',
            default => null,
        };
    }
}
