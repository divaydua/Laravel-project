<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();                                  // Primary key, auto-increments
            $table->unsignedBigInteger('post_id');         // Foreign key to posts table
            $table->unsignedBigInteger('user_id');         // Foreign key to users table
            $table->text('content');                       // Content of the comment
            $table->timestamps();                          // Timestamps for created_at and updated_at
        
            // Foreign key constraints
            $table->foreign('post_id') ->references('id')->on('posts')  // Foreign key post_id mapped to comment_id  
                ->onDelete('cascade')->onUpdate('cascade'); //Deletes and updates comments if the post is deleted/updated

            $table->foreign('user_id')->references('id')->on('users')  // Foreign key user_id mapped to comment_id        
                  ->onDelete('cascade')->onUpdate('cascade'); // Deletes/Updates comments if the user is deleted/updated
                         
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
