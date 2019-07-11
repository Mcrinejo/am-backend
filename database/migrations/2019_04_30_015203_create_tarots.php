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
            $table->string('userId');
            $table->string('question');
            $table->string('status');
            $table->string('answer')->nullable();
            $table->timestamp('orderDate')->nullable();
            $table->timestamp('appointmentDate')->nullable(); 
            $table->string('pullType');
            $table->boolean('presence');
        });
        // Schema::table('tarots', function(Blueprint $table) {
        //     // $table->foreign('userId')->references('id')->on('users');
        // });
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
