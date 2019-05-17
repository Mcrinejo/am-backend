<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tarot extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'usuario_id', 'preguntas', 'respuestas','estado','fecha_pedido', 'fecha_cita', 'tipos_tirada', 'presencial'
    ];
}
