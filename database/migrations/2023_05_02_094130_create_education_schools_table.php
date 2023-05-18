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
        Schema::create('education_schools', function (Blueprint $table) {
            $table->id();
            $table->integer('education_id');
            $table->string('school_name');
            $table->string('education_description');
            $table->string('applied_date');
            $table->string('school_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_schools');
    }
};
