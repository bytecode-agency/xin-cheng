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
        Schema::create('education_parents', function (Blueprint $table) {
            $table->id();
            $table->string('education_id');
            $table->string('pass_name_eng');
            $table->string('pass_name_chinese');
            $table->string('relationship_with_client');
            $table->string('gender');
            $table->string('dob');
            $table->string('pass_no');
            $table->string('pass_reminder');
            $table->string('pass_expiry_date');
            $table->string('pass_trigger_frq');
            $table->string('pass_country');
            $table->string('job_occupation');
            $table->string('annual_income');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_parents');
    }
};
