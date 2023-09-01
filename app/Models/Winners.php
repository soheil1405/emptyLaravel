<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Winners extends Model
{
    use HasFactory , SoftDeletes;



    protected $table = "winners";


    protected $fillable = [
        'user_id',
        'question_id',
        'time',
        'deleted_at' ,
    ];




    public function question(){
        return $this->belongsTo(questions::class , 'question_id');
    }



    public function user(){
        return $this->belongsTo(User::class);
    }




}
