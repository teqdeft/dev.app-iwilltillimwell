<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyRelationsInHealthRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication', function (Blueprint $table) {
            $table->unsignedBigInteger('userId')->after('id');
            $table->foreign('userId')->references('id')->on('users');
        });

        Schema::table('medical_conditions', function (Blueprint $table) {
            $table->unsignedBigInteger('userId')->after('id');
            $table->foreign('userId')->references('id')->on('users');
        });

        Schema::table('medication_allergy', function (Blueprint $table) {
           $table->unsignedBigInteger('userId')->after('id');
           $table->foreign('userId')->references('id')->on('users');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medication', function (Blueprint $table) {
            $table->dropForeign(['userId']);
            $table->dropColumn('userId');
        });
        Schema::table('medical_conditions', function (Blueprint $table) {
            $table->dropForeign(['userId']);
            $table->dropColumn('userId');
        });
        Schema::table('medication_allergy', function (Blueprint $table) {
            $table->dropForeign(['userId']);
            $table->dropColumn('userId');
        });
    }
}
