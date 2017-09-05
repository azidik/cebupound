<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpoundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impoundings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pet_id');
            $table->string('place_founded');
            $table->dateTime('surrendered_at');
            $table->string('surrendered_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impoundings');
    }
}
