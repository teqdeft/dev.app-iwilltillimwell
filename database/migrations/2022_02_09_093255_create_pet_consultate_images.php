<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetConsultateImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_consultate_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('myPetConslutId');
            $table->foreign('myPetConslutId')->references('id')->on('pet_consultations');
            $table->longText('images');
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
        Schema::dropIfExists('pet_consultate_images');
    }
}
