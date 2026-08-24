<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCbtFeelToCbtsTable extends Migration
{
    public function up()
    {
        Schema::table('cbts', function (Blueprint $table) {
            $table->string('cbt_feel')
                  ->nullable()
                  ->after('alternative_thought');
        });
    }

    public function down()
    {
        Schema::table('cbts', function (Blueprint $table) {
            $table->dropColumn('cbt_feel');
        });
    }
}