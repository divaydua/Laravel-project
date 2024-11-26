<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        // Ensure there are users to associate notifications with
        if (User::count() < 2) {
            $this->command->info('Please seed the users table first.');
            return;
        }

        $users = User::all();

        // Generate 10 dummy notifications
        foreach (range(1, 10) as $index) {
            Notification::create([
                'sender_id' => $users->random()->id, // Random sender
                'receiver_id' => $users->random()->id, // Random receiver
                'type' => 'like', // Example: 'like'
                'message' => 'User liked your post.', // Example message
                'is_read' => false, // Mark as unread
            ]);
        }
    }
}