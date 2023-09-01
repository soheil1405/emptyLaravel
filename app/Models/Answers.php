<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answers extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'question_id',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'deleted_at' ,
    ];

}
