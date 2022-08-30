<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_id',
        'title',
        'image',
        'voice',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class, 'question_id');
    }
}
