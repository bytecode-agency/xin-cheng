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
        Schema::create('wealth_passes', function (Blueprint $table) {
            $table->id();
            $table->string('passholder_shareholder');
            $table->string('pass_holder_name');
            $table->string('passposrt_name_chinese');
            $table->string('dob');
            $table->string('gender');
            $table->string('passport_expiry_date');
            $table->string('passport_no');
            $table->string('passport_renewal_reminder');
            $table->string('passport_tri_frq');
            $table->string('tin_country_before_app');
            $table->string('type_of_tin_before_app');
            $table->string('tin_no_before_pass_app');
            $table->string('phone_no');
            $table->string('email');
            $table->string('business_type');
            $table->string('residential_add');
            $table->string('pass_app_status');
            $table->string('relation_with_pass');
            $table->string('pass_app_type');
            $table->string('pass_inssuance');
            $table->string('pass_issuance_date');
            $table->string('pass_expiry_date');
            $table->string('pass_renewal_reminder');
            $table->string('duration');
            $table->string('fin_number');
            $table->string('pass_renewal_frq');
            $table->string('pass_jon_title');
            $table->string('singpass_set_up');
            $table->string('employee_name');
            $table->string('monthly_sal');
            $table->string('pass_remarks');
           


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_passes');
    }
};
