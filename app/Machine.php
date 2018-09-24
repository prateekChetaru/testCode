<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Machine extends Authenticatable
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

    public function office()
    {
        return $this->belongsTo('App\Office');
    }

    public function answer()
    {
        return $this->hasMany('App\Mdr_answer', 'machine_id', 'id');

    }
    /*get machine , user directive form */
    public function udrForm()
    {
        return $this->hasOne('App\Udr_form', 'id', 'user_dir_id');
    }

    /*get machine user directive operation user */
    public function machineOperatorUser()
    {
        return $this->hasMany('App\Udr_operation_history', 'machine_id','id');
    }

}
