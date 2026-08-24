<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDistortionInformationToCbtsTable extends Migration
{
    public function up()
    {
        Schema::table('cbts', function (Blueprint $table) {
            $table->json('distortion_information')
                  ->nullable()
                  ->after('cbt_feel');
        });
    }

    public function down()
    {
        Schema::table('cbts', function (Blueprint $table) {
            $table->dropColumn('distortion_information');
        });
    }
}