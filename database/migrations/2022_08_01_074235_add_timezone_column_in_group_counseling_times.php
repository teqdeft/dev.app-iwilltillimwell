<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimezoneColumnInGroupCounselingTimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_counseling_times', function (Blueprint $table) {
            $table->string('time_zone')->nullable()->after('endTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_counseling_times', function (Blueprint $table) {
            $table->dropColumn('time_zone');
        });
    }
}
