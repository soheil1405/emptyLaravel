<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\auth\authverifyCode;
use App\Models\auth\authverifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'number',
        'city_id',
        'class_level_id',
        'fileds_of_studys_id',
        'email',
        'password',
        'email_verified_at',
        'allAnwers_count',
        'CurrectAnwers_count',
        'WrongAnwers_count',
        'winningCount',
        'deleted_at',
        'mojoodi',
        'mobile_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rolation()
    {
        return $this->hasOne(user_roles::class);
    }

    public function EmailVerifyCode()
    {
        return $this->hasOne(authverifyCode::class)->where('for' , 'email');
    }

    public function mobileVerifyCode()
    {
        return $this->hasOne(authverifyCode::class)->where('for' , 'mobile');

    }
    public function city()
    {
        return $this->belongsTo(cities::class, 'city_id')->OrderBy('name');
    }

    public function classLevel()
    {
        return $this->belongsTo(classLevels::class, 'class_level_id')->OrderBy('name');
    }

    public function filedOfStudy()
    {
        return $this->belongsTo(Fileds_of_studys::class, 'fileds_of_studys_id')->OrderBy('name');
    }

    public function userAnswers()
    {
        return $this->hasMany(user_answer::class, 'user_id')->latest();
    }

    public function userLastAnswers()
    {
        return $this->hasMany(user_answer::class, 'user_id')->latest();
    }

    public function userWrongAnswers()
    {

        return $this->hasMany(user_answer::class, 'user_id')->where('status', 0);

    }

    public function userCurrectAnswers()
    {

        return $this->hasMany(user_answer::class, 'user_id')->where('status', 1);

    }

    public function winns()
    {
        return $this->hasMany(Winners::class, 'user_id')->latest();
    }

    public function role()
    {

        return $this->hasOne(user_roles::class);

    }



    public function Payments(){
        return $this->hasMany(payment::class , 'user_id')->latest();
    }

    public function lastPayment(){
        return $this->hasOne(payment::class , 'user_id')->latest();
    }


}
