@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Notifications</h1>

    @if ($notifications->isEmpty())
    <p class="text-gray-500">No notifications to show.</p>
@else
    <ul class="divide-y divide-gray-200">
        @foreach ($notifications as $notification)
            <li class="p-4 flex justify-between items-center {{ $notification->is_read ? 'bg-gray-100' : 'bg-gray-50' }}">
                <div>
                    <p class="text-gray-800">{{ $notification->message }}</p>
                    <p class="text-sm text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex space-x-4">
                    @if (!$notification->is_read)
                        <form method="POST" action="{{ route('notifications.markAsRead') }}">
                            @csrf
                            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                            <button type="submit" class="text-blue-500 hover:underline">Mark as Read</button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endif

    @if ($notifications->isNotEmpty())
        <form method="POST" action="{{ route('notifications.markAllAsRead') }}" class="mt-6">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                Mark All as Read
            </button>
        </form>
    @endif
</div>
@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.mark-as-read-button').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const notificationId = button.dataset.notificationId;

            try {
                const response = await fetch('/notifications/mark-as-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ notification_id: notificationId }),
                });

                if (response.ok) {
                    button.closest('li').classList.add('bg-gray-100');
                    button.remove(); // Remove the "Mark as Read" button
                }
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        });
    });
});

@endsection