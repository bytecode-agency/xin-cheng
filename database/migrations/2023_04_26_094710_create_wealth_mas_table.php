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
        Schema::create('wealth_mas', function (Blueprint $table) {
            $table->id();
            $table->string('account_status');
            $table->string('tax_advisor_name');
            $table->string('tax_advisor_email');
            $table->string('tax_advisor_no');
            $table->string('kickstart_tax_advisor');
            $table->string('deck_submission');
            $table->string('presentation_deck');
            $table->string('masnet_account');
            $table->string('preliminary_approval');
            $table->string('final_approval');
            $table->string('final_submission');
            $table->string('oic_name');
            $table->string('masnet_username');
            $table->string('masnet_password');
            $table->string('institution_code');
            $table->string('declaration_frequency');
            $table->string('commencement_date');
            $table->string('reminder_notification');
            $table->string('annual_declaration_deadline');
            $table->string('internal_account_manager');
            $table->string('trigger_fqy_rem');
            $table->string('remarks');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_mas');
    }
};
