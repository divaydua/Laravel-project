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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();                                  // Primary key, auto-increments
            $table->unsignedBigInteger('post_id');         // Foreign key to posts table
            $table->unsignedBigInteger('user_id');         // Foreign key to users table
            $table->text('content');                       // Content of the comment
            $table->timestamps();                          // Timestamps for created_at and updated_at
        
            // Foreign key constraints
            $table->foreign('post_id')
                  ->references('id')->on('posts')          // References id on posts table
                  ->onDelete('cascade')                    // Deletes comments if the post is deleted
                  ->onUpdate('cascade');                   // Updates the foreign key if the post id changes
        
            $table->foreign('user_id')
                  ->references('id')->on('users')          // References id on users table
                  ->onDelete('cascade')                    // Deletes comments if the user is deleted
                  ->onUpdate('cascade');          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
