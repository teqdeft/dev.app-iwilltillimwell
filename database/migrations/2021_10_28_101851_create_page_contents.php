<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id');
            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreignId('parent_id')->nullable();;
            $table->foreign('parent_id')->references('id')->on('page_contents');
            $table->enum('type', ['text', 'single-image', 'slider', 'gallery', 'galleryt2', 'boarding'])->default('text');
            $table->string('section_title')->nullable();
            $table->string('section_name')->nullable();
            $table->longText('section_content')->nullable();
            $table->string('section_file')->nullable();
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
        Schema::dropIfExists('page_contents');
    }
}
