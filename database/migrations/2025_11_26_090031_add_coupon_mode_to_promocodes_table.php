<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCouponModeToPromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            
			$table->enum('coupon_mode', ['package', 'holiday'])
                  ->default('package')
                  ->after('commission_to');
				  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		
        Schema::table('promocodes', function (Blueprint $table) {
            
			$table->dropColumn('coupon_mode');
			
        });
    }
}
