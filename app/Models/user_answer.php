<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_answer extends Model
{   
    use HasFactory , SoftDeletes;

    protected $table = "user_answer";

    protected $fillable = [
        'question_id',
        'user_id',
        'choiced_answer_item' ,
        'status' ,
        'deleted_at'
    ];



    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }


    public function question(){
     return $this->belongsTo(questions::class , 'question_id');   
    }



}
