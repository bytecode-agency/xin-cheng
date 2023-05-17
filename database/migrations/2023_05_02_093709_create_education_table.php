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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('education_level');
            $table->string('client_name');
            $table->string('client_pass_name');
            $table->string('client_current_pass');
            $table->string('gender');
            $table->string('dob');
            $table->string('pass_no');
            $table->string('pass_country');
            $table->string('pass_exp_date');
            $table->string('pass_renewal_reminder');
            $table->string('pass_trigger_frq');
            $table->string('phone_no');
            $table->string('email');
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
        Schema::dropIfExists('education');
    }
};
