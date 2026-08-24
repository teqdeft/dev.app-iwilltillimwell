<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
			
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_withdrawal', 10, 2)->default(0);
            $table->decimal('grand_withdrawal', 10, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

           
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};