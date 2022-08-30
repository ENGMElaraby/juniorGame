<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'title',
        'image',
        'voice',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
