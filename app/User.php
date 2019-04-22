<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\role;



class User extends Model
{
    use SoftDeletes;
    public $timestamps = false;

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
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
}

