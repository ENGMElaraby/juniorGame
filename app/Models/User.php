<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, \OwenIt\Auditing\Auditable;

    const TokenName = 'Lamer';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'parent_name',
        'email',
        'mobile',
        'password',
        'governorate_id',
        'education_center_id',
        'device_token',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'created_at'
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
     * @param $value
     * @return string
     */
    final public function getPhotoAttribute($value): string
    {
        return $value ?? asset('assets/img/boy.png');
    }

    /**
     * @param $value
     * @return string
     */
    final public function getFullNameAttribute($value): string
    {
        return $this->first_name . ' ' . $this->parent_name;
    }

    /**
     * @return BelongsTo
     */
    final public function getGovernorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    /**
     * @return BelongsTo
     */
    final public function getCenter(): BelongsTo
    {
        return $this->belongsTo(EducationCenter::class, 'education_center_id');
    }

}
