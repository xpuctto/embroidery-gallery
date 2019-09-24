<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmbroideryLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embroidery_location', function (Blueprint $table) {
            $table->integer('embroidery_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->foreign('embroidery_id')->references('id')->on('embroideries');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embroidery_location');
    }
}
