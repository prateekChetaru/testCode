<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Udr_question extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $guarded = [
        'id'
    ];

    public function option()
    {
        return $this->hasMany('App\Udr_form_option_choice','question_id','id');
    }

    public function form()
    {
        return $this->belongsTo('App\Udr_form','form_id','id');
    }

}
