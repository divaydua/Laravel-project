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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();                                  // Primary key, auto-increments
            $table->unsignedBigInteger('user_id');         // Foreign key to users table
            $table->text('content');                       // Content of the post
            $table->timestamps();                          // Timestamps for created_at and updated_at
        
            // Foreign key constraint
            $table->foreign('user_id')
                  ->references('id')->on('users')          // Ensure 'users' is plural
                  ->onDelete('cascade')                    // Deletes posts if the user is deleted
                  ->onUpdate('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
