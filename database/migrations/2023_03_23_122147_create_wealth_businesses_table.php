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
        Schema::create('wealth_businesses', function (Blueprint $table) {
            $table->id();
            $table->integer('wealth_id');
            $table->string('type_of_fo');
            $table->string('servicing_fee');
            $table->string('servicing_fee_currency');
            $table->string('servicing_fee_status');
            $table->string('annual_servicing_fee');
            $table->string('annual_fee_currency');
            $table->string('annual_fee_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_businesses');
    }
};
