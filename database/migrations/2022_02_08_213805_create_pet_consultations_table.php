<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iwill_pet_id');
            $table->foreign('iwill_pet_id')->references('id')->on('pets');
            $table->integer('phoneNumber');
            $table->string('modality');
            $table->integer('problemId');
            $table->text('description');
            $table->integer('optIn');
            $table->longText('videoSessionId')->nullable();
            $table->bigInteger('openToKApiKey')->nullable();
            $table->longText('primaryPatientToken')->nullable();
            $table->dateTime('whenScheduled')->nullable();
            $table->unsignedBigInteger('petConsultId');
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
        Schema::dropIfExists('pet_consultations');
    }
}
