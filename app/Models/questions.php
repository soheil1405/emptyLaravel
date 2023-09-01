<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class questions extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'q_image',
        'cucrrect_answer_item',
        'allAnswersCount',
        'CurrectAnswersCount',
        'WrongAnswersCount',
        'time',
        'linkToInstaAnswer',
        'deleted_at' ,
        'answer_time'

    ];

    public function answers(){
        return $this->hasOne(Answers::class , 'question_id');
    }


    public function userAnswers(){
        return $this->hasMany(user_answer::class , 'question_id');
    }

    public function userCurrectAnswers(){
        return $this->hasMany(user_answer::class , 'question_id')->where('choiced_answer_item' , $this->cucrrect_answer_item );
    }



    public function userWrongAnswers(){
        return $this->hasMany(user_answer::class , 'question_id')->where('choiced_answer_item' , '!=' , $this->cucrrect_answer_item );
    }


    public function userWinner(){

        return $this->hasMany(Winners::class ,'question_id');

    }
}
