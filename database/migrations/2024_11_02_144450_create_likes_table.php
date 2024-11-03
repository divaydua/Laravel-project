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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();                                  // Primary key, auto-increments
    $table->unsignedBigInteger('user_id')->unique();         // Foreign key to users table
    $table->unsignedBigInteger('post_id')->unique();         // Foreign key to posts table
    $table->timestamps();                          // Timestamps for when the like was created

    // Foreign key constraints
    $table->foreign('user_id')
          ->references('id')->on('users')          // References id on users table
          ->onDelete('cascade')                    // Deletes like if the user is deleted
          ->onUpdate('cascade');                   // Updates the foreign key if the user id changes

    $table->foreign('post_id')
          ->references('id')->on('posts')          // References id on posts table
          ->onDelete('cascade')                    // Deletes like if the post is deleted
          ->onUpdate('cascade');                   // Updates the foreign key if the post id changes

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
