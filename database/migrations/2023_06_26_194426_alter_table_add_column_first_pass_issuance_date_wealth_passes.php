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
        Schema::table('wealth_passes', function (Blueprint $table) {
            $table->date('first_pass_issuance_date')->after('pass_inssuance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wealth_passes', function (Blueprint $table) {
            $table->dropColumn('first_pass_issuance_date');
        });
    }
};
