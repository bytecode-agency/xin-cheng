<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wealths', function (Blueprint $table) {
            $table->id();
           
            $table->integer('user_id');
            $table->string('business_type');
            $table->integer('business_id');   
            $table->integer('company_id'); 
            $table->string('client_type');          
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealths');
    }
};
