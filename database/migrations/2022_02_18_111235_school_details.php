<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchoolDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoold_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id');
            $table->foreign('visitor_id')->references('id')->on('visitors');
            $table->string('name')->nullable();
            $table->string('student_id')->nullable();
            $table->string('printed_name')->nullable();
            $table->string('signature_path')->nullable();
            $table->string('mentioned_date')->nullable();
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
        Schema::dropIfExists('schoold_details');
    }
}
