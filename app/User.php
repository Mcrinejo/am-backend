<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use SoftDeletes;
    public $timestamps = false;
    use HasApiTokens, Notifiable;

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','zipcode','city', 'country', 'birthdate', 'address', 'confirmed', 'confirmation_code', 'deleted_at'
    ];
    protected $hidden = [
        'password'
    ];
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
}

