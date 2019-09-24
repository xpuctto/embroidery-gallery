<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmbroideryStitch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embroidery_stitch', function (Blueprint $table) {
            $table->integer('embroidery_id')->unsigned();
            $table->integer('stitch_id')->unsigned();
            $table->foreign('embroidery_id')->references('id')->on('embroideries');
            $table->foreign('stitch_id')->references('id')->on('stitches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embroidery_stitch');
    }
}
