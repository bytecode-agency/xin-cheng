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
        Schema::create('wealth_shareholders', function (Blueprint $table) {
            $table->id();
            $table->integer('wealth_id');
            $table->string('equity_percentage');
            $table->string('pass_name_eng');
            $table->string('pass_name_chinese');
            $table->string('passport_renew');
            $table->string('gender');
            $table->string('dob');
            $table->string('passport_trg_fqy');
            $table->string('passport_no');
            $table->string('passport_exp_date');
            $table->string('passport_country');
            $table->string('email');
            $table->string('phone');
            $table->string('residential_address');
            $table->string('tin_no');
            $table->string('tin_country');
            $table->string('type_of_tin');
            $table->string('job_title');
            $table->string('monthly_sal');
            $table->string('relation_with_shareholder');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_shareholders');
    }
};
