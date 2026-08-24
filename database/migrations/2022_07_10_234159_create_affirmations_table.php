<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affirmations', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->integer('type')->default(0)->comment('0 => type,1 => messages');
            $table->integer('parent_type')->nullable();
            $table->integer('message_send')->default(0)->comment('0 => not send,1 => send')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affirmations');
    }
}
