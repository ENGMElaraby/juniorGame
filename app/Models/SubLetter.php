<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLetter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'letter',
        'word',
        'image',
        'voice',
        'status',
        'letter_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
