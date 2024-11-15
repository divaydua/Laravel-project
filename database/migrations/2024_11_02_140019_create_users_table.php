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
        Schema::create('user', function (Blueprint $table) {
            $table->id();                      // Primary key, auto-increments
            $table->string('name');            // Name of the user
            $table->string('email')->unique(); // Unique email for each user
            $table->timestamp('email_verified_at')->nullable(); // Verification timestamp
            $table->string('password');        // Password for authentication
            $table->date('date_of_birth')->nullable(); // Date of birth of the user, optional
            $table->timestamps();              // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
