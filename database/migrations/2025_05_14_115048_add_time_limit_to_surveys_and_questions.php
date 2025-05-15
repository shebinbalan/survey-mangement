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
    Schema::table('surveys', function (Blueprint $table) {
        $table->integer('time_limit')->nullable(); // in seconds
    });

    Schema::table('questions', function (Blueprint $table) {
        $table->integer('time_limit')->nullable(); // in seconds
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveys_and_questions', function (Blueprint $table) {
            //
        });
    }
};
