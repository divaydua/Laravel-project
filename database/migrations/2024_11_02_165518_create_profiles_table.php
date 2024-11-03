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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();                                     // Primary key
            $table->unsignedBigInteger('user_id')->unique();  // Foreign key to users table
            $table->text('bio')->nullable();                  // Bio of the user
            $table->string('profile_picture')->nullable();    // Profile picture URL
            $table->timestamps();                             // Timestamps

            // Foreign key constraint
            $table->foreign('user_id') ->references('id')->on('users') // Foreign key user_id mapped to profile_id
            ->onDelete('cascade') ->onUpdate('cascade');    // Deletes/Updates profile if the user is Deleted/Updated
                     
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
