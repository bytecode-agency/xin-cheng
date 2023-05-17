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
        Schema::create('wealth_financials', function (Blueprint $table) {
            $table->id();
            $table->string('stakeholder_type');
            $table->string('financial_institution_name');
            $table->string('poc_name');
            $table->string('poc_contact_no');
            $table->string('poc_email');
            $table->string('application_submission');
            $table->string('account_type');
            $table->string('account_policy_no');
            $table->string('account_opening_status');
            $table->string('current_account_status');
            $table->string('money_deposit_status');
            $table->string('intial_deposit_amount');
            $table->string('online_account_username');
            $table->string('online_account_pass');
            $table->string('finacial_remarks');          

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_financials');
    }
};
