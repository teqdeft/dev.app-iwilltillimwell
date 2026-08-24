<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrganizationIdToOrganizationsRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations_rewards', function (Blueprint $table) {
            
			$table->unsignedBigInteger('organization_id')
                  ->nullable()
                  ->after('id');
			
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations_rewards', function (Blueprint $table) {
            $table->dropColumn('organization_id');

        });
    }
}
