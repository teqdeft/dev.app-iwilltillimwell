<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedicationIdToMedicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication', function (Blueprint $table) {
            $table->integer('medicationId')->nullable()->after('userId');
            $table->string('frequency')->change();
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
            $table->dropColumn('medicationId');
            $table->dropColumn('frequency');
        });
    }
}
