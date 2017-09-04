<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterImpoundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('impoundings', function (Blueprint $table) {
            $table->string('place_founded')->nullable()->change();
            $table->string('surrendered_at')->nullable()->change();
            $table->string('surrendered_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('impoundings', function (Blueprint $table) {
            //
        });
    }
}
