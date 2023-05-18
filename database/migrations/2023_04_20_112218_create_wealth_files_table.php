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
        Schema::create('wealth_files', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->string('file_name');
            $table->integer('wealth_id');
            $table->integer('uploaded_by_id');
            $table->string('uploaded_by_name');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wealth_files');
    }
};
