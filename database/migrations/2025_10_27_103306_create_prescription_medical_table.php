<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionMedicalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_medical', function (Blueprint $table) {
            
			$table->id();
            $table->string('medical_name')->nullable();
            $table->string('prescription_section')->nullable();
            $table->string('block_section')->nullable();
            $table->boolean('status')->default(1)->comment('1 = Active, 0 = Inactive');
            $table->timestamps();
			
			$table->index('id');
            $table->index('medical_name');
            $table->index('prescription_section');
            $table->index('status');
			
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_medical');
    }
}
