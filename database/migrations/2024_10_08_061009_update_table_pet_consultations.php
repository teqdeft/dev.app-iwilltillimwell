<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablePetConsultations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pet_consultations', function (Blueprint $table) {
            $table->string('problemId')->change();
            $table->string('phoneNumber')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('optIn')->nullable()->change();
            $table->text('petConsultId')->nullable()->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pet_consultations', function (Blueprint $table) {
            $table->integer('problemId')->change();
            $table->integer('phoneNumber')->change();
            $table->integer('optIn')->change();
            
        });
    }
}

?>