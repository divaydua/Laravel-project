<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();                                            // Primary key, auto-increments
            $table->unsignedBigInteger('user_id')->unique();         // Foreign key to users table
            $table->unsignedBigInteger('post_id')->unique();         // Foreign key to posts table
            $table->timestamps();                                    // Timestamps for when the like was created

    // Foreign key constraints
    $table->foreign('user_id')->references('id')->on('users') // Foreign key user_id mapped to like_id
    ->onDelete('cascade') ->onUpdate('cascade');      
                        

    $table->foreign('post_id') ->references('id')->on('posts') //Foreign key post_id mapped to like_id
    ->onDelete('cascade')->onUpdate('cascade');   
                      
                         

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
