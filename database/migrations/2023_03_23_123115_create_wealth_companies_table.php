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
        Schema::create('wealth_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('wealth_id');
            $table->integer('shareholder_id');
            $table->string('name');
            $table->string('uen');
            $table->string('address');
            $table->string('incorporate_date');
            $table->string('company_email');
            $table->string('company_pass');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_companies');
    }
};
