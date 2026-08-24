<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChiefProblemOtherProblemsColumnToConsultations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->string('roi')->nullable()->after('translate');
            $table->string('cheifComplaint')->nullable()->after('roi');
            $table->string('otherProblems')->nullable()->after('cheifComplaint');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn('roi');
            $table->dropColumn('cheifComplaint');
            $table->dropColumn('otherProblems');
        });
    }
}
