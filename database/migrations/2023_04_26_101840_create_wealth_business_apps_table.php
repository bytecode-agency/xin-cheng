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
        Schema::create('wealth_business_apps', function (Blueprint $table) {
            $table->id();
            $table->string('financial_institition_name');
            $table->string('application_submision');
            $table->string('business_account_status');
            $table->string('business_account_type');
            $table->string('business_account_policy_no');
            $table->string('product_name');
            $table->string('payment_mode');
            $table->string('currency');
            $table->string('investment_amount');
            $table->string('online_account_user');
            $table->string('online_acc_pass');
            $table->string('subscription');
            $table->string('maturity_date');
            $table->string('business_duration');
            $table->string('maturity_reminder');
            $table->string('maturity_reminder_trg');
            $table->string('commision_status');
            $table->string('commission_currency');
            $table->string('commission_amount');
            $table->string('net_amount_val');
            $table->string('business_remarks');
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_business_apps');
    }
};
