<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAkashicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akashics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('permission');
            $table->timestamp('orderDate');
            $table->string('subjects');
            $table->string('status');
            $table->string('devolution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akashic_records');
    }
}
