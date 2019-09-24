<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmbroideriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('embroideries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('city_id')->nullable();
            $table->string('name')->nullable();
            $table->string('village')->nullable();
            $table->string('annotation')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('image_authors')->nullable();
            $table->string('owner')->nullable();
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
        Schema::dropIfExists('embroideries');
    }
}
