<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiryDateAndAutoRenewalToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('auto_renewal')->default(false)->after('organization_id');
            $table->date('expiry_date')->nullable()->after('auto_renewal');
            $table->bigInteger('plan')->unsigned()->nullable()->after('expiry_date');
            $table->foreign('plan')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('auto_renewal');
            $table->dropColumn('expiry_date');
        });
    }
}
