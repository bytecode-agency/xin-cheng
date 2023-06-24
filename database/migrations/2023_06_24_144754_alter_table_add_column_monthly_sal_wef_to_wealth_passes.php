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
            $table->date('monthly_sal_wef')->after('monthly_sal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wealth_passes', function (Blueprint $table) {
            $table->dropColumn('monthly_sal_wef');
        });
    }
};
