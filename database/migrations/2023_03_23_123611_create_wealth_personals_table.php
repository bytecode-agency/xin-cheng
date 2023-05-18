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
        Schema::create('wealth_personals', function (Blueprint $table) {
            $table->id();
            $table->integer('wealth_id');
            $table->string('pass_name_eng');
            $table->string('pass_name_chinese');
            $table->string('gender');
            $table->string('dob');
            $table->string('passport_no');
            $table->string('passport_exp_date');
            $table->string('passport_renew');
            $table->string('passport_country');
            $table->string('passport_trg_fqy');
            $table->string('tin_no');
            $table->string('tin_country');
            $table->string('tin_before_application');
            $table->string('type_of_tin');
            $table->string('email');
            $table->string('tin_country_before_app');
            $table->string('residential_address');
            $table->string('type_pin_before_app');
            $table->string('employer_industry');
            $table->string('phone');
            $table->string('job_title');
            $table->string('employer_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_personals');
    }
};
