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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // User who triggers the notification
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // User receiving the notification
            $table->string('type'); // Type of notification (e.g., 'like', 'comment', 'follow')
            $table->text('message')->nullable(); // Optional message for the notification
            $table->boolean('is_read')->default(false); // Read/unread status
            $table->timestamps(); // Created at, updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
