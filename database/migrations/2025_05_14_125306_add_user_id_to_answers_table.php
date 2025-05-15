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
        Schema::table('answers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('question_id'); // Add this line
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key relationship to users table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
             $table->dropForeign(['user_id']);
              $table->dropColumn('user_id');
        });
    }
};
