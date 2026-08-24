<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_counselings', function (Blueprint $table) {
            $table->date('last_registration_date')->nullable()->after('registration_fee');
            $table->date('session_start_date')->nullable()->after('registration_fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_counselings', function (Blueprint $table) {
            $table->dropColumn('last_registration_date');
            $table->dropColumn('session_start_date');
        });
    }
}
