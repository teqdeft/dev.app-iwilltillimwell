<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('sort')->nullable()->after('parent_id');
            $table->longText('slug')->nullable()->after('sort');
            $table->integer('status')->default(1)->after('slug');
            $table->dropForeign(['parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('sort');
            $table->dropColumn('slug');
            $table->dropColumn('status');
            $table->foreign('parent_id')->references('id')->on('pages');
        });
    }
}
