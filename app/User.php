<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','zipcode','city', 'country', 'birthdate', 'address', 'confirmed', 'confirmation_code', 'external_id', 'created_at', 'update_at', 'deleted_at'
    ];
}

