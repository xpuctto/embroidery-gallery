<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmbroiderySymbol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embroidery_symbol', function (Blueprint $table) {
            $table->integer('embroidery_id')->unsigned();
            $table->integer('symbol_id')->unsigned();
            $table->foreign('embroidery_id')->references('id')->on('embroideries');
            $table->foreign('symbol_id')->references('id')->on('symbols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('embroidery_symbol');
    }
}
