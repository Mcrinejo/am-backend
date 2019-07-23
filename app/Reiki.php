<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reiki extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'userId','status','devolution', 'orderDate', 'permission'
    ];
}
