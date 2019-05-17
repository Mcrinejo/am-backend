<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->string('preguntas');
            $table->string('estado');
            $table->string('respuestas');
            $table->timestamp('fecha_pedido')->nullable();
            $table->timestamp('fecha_cita')->nullable(); 
            $table->string('tipos_tirada');
            $table->boolean('presencial');
        });
        Schema::table('tarots', function(Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_tarots');
    }
}
