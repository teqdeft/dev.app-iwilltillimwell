<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldToMedicalAllegry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication_allergy', function (Blueprint $table) {
            $table->integer('addedAllergyId')->nullable()->after('userId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medication_allergy', function (Blueprint $table) {
            $table->dropColumn('addedAllergyId');
        });
    }
}
