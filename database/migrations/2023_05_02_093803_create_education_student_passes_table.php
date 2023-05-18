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
        Schema::create('education_student_passes', function (Blueprint $table) {
            $table->id();
            $table->string('education_id');
            $table->string('need_of_student_pass');
            $table->string('pass_application_status');
            $table->string('pass_issuance');
            $table->string('pass_issuance_date');
            $table->string('pass_expiry_date');
            $table->string('pass_duration');
            $table->string('pass_renewal_reminder');
            $table->string('fin_number');
            $table->string('pass_renewal_frq');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_student_passes');
    }
};
