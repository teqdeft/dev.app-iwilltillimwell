<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSureScriptPharmacyIdToUserPharmaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_pharmacies', function (Blueprint $table) {
            $table->bigInteger('sureScriptPharmacy_id')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_pharmacies', function (Blueprint $table) {
            $table->dropColumn('sureScriptPharmacy_id');
        });
    }
}
