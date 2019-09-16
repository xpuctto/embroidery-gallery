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
            $table->bigIncrements('id');
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('city_id');
            $table->string('village');
            $table->text('description');
            $table->string('annotation');
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
