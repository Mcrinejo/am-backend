<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tarot extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'userId', 'question', 'answer','status','orderDate', 'appointmentDate', 'pullType', 'presence'
    ];
}
