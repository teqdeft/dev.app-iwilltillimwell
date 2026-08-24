<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserIdColumnsFromHealthRecordTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication', function (Blueprint $table) {
            $table->dropColumn('userId');
        });
        Schema::table('medical_conditions', function (Blueprint $table) {
            $table->dropColumn('userId');
        });
        Schema::table('medication_allergy', function (Blueprint $table) {
            $table->dropColumn('userId');
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
            $table->integer('userId')->nullable()->after('id');
        });
        Schema::table('medical_conditions', function (Blueprint $table) {
            $table->integer('userId')->nullable()->after('id');
        });
        Schema::table('medication_allergy', function (Blueprint $table) {
            $table->integer('userId')->nullable()->after('id');
        });
    }
}
