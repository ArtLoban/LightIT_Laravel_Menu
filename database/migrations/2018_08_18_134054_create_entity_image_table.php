<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned()->index();
            $table->foreign('entity_id')->references('id')->on('entities');
            $table->integer('image_id')->unsigned()->index();
            $table->foreign('image_id')->references('id')->on('images');
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
        Schema::dropIfExists('entity_image');
    }
}
