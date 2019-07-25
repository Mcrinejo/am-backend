<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akashic extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'userId','status','orderDate', 'devolution', 'subject', 'permission'
    ];
}
