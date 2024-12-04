<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Fetch notifications for the logged-in user
        $notifications = Notification::where('receiver_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $request->validate([
            'notification_id' => 'required|exists:notifications,id',
        ]);

        $notification = Notification::findOrFail($request->notification_id);

        // Ensure the notification belongs to the user
        if ($notification->receiver_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read']);
    }

    public function markAllAsRead()
{
    // Mark all notifications for the authenticated user as read
    auth()->user()->notifications()->update(['is_read' => true]);

    return redirect()->route('notifications.index')->with('success', 'All notifications marked as read.');
}

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        // Ensure the notification belongs to the user
        if ($notification->receiver_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}