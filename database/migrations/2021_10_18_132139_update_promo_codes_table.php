<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            $table->dropColumn('influencer_name');
            $table->dropColumn('influencer_email');
            $table->dropColumn('influencer_payable_amount');
            $table->dropColumn('status');
            $table->integer('influencer_id')->after('code');
            $table->softDeletes();
            $table->renameColumn('commission_type', 'influencer_commission_type');
            $table->renameColumn('commission_amount', 'influencer_commission_amount');
            $table->renameColumn('member_commission_type', 'member_discount_type');
            $table->renameColumn('member_commission_amount', 'member_discount_amount');
            $table->date('commission_from')->nullable()->after('stripe_id');
            $table->date('commission_to')->nullable()->after('commission_from');
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
            $table->string('influencer_name');
            $table->string('influencer_email')->unique();
            $table->dropColumn('influencer_id');
            $table->dropSoftDeletes();
            $table->TinyInteger('status')->comment('0 => Pending, 1 => Paid')->default('0')->after('influencer_email');
            $table->renameColumn('influencer_commission_type', 'commission_type');
            $table->renameColumn('influencer_commission_amount', 'commission_amount');
            $table->renameColumn('member_discount_type', 'member_commission_type');
            $table->renameColumn('member_discount_amount', 'member_commission_amount');
            $table->dropColumn('commission_from');
            $table->dropColumn('commission_to');
            $table->string('influencer_payable_amount')->nullable();
        });
    }
}
