<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupCounselingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_counseling_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_counseling_id');
            $table->foreign('group_counseling_id')->references('id')->on('group_counselings')->onDelete('cascade');
            $table->date('date');
            $table->time('startTime');
            $table->time('endTime');
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
        Schema::dropIfExists('group_counseling_times');
    }
}
