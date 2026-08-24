<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('heightFeet')->nullable();
            $table->integer('heightInches')->nullable();
            $table->integer('smokingHabits')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('drinkingHabits')->nullable();
            $table->integer('bloodType')->nullable();
            $table->integer('exerciseHabits')->nullable();
            $table->integer('exerciseLength')->nullable();
            $table->integer('bloodPressureSystolic')->nullable();
            $table->integer('bloodPressureDiastolic')->nullable();
            $table->integer('maritalStatus')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
