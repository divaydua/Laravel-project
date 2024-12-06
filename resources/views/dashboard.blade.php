<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-200">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">My Social Media App</h1>
            <div>
                <a href="/profiles" class="text-gray-300 hover:text-white px-4 py-2 rounded">My Profile</a>
                <a href="/logout" class="text-gray-300 hover:text-white px-4 py-2 rounded">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gray-800 rounded-lg shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-200">Welcome, User!</h2>
                <p class="text-gray-400 mt-2">This is your dashboard where you can manage your posts, interact with others, and explore features.</p>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- View Posts -->
                <div class="bg-gray-700 p-6 rounded-lg shadow text-center hover:bg-gray-600 transition">
                    <h3 class="text-lg font-semibold text-gray-200">View All Posts</h3>
                    <p class="text-gray-400 mt-2">Browse all posts from you and others.</p>
                    <a href="/posts" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Go to Posts</a>
                </div>

                <!-- Create Post -->
                <div class="bg-gray-700 p-6 rounded-lg shadow text-center hover:bg-gray-600 transition">
                    <h3 class="text-lg font-semibold text-gray-200">Create a New Post</h3>
                    <p class="text-gray-400 mt-2">Share your thoughts with everyone.</p>
                    <a href="/posts/create" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Create Post</a>
                </div>

                <!-- View Notifications -->
                <div class="bg-gray-700 p-6 rounded-lg shadow text-center hover:bg-gray-600 transition">
                    <h3 class="text-lg font-semibold text-gray-200">View Notifications</h3>
                    <p class="text-gray-400 mt-2">Check who interacted with your posts and comments.</p>
                    <a href="/notifications" class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">View Notifications</a>
                </div>
            </div>

            <!-- Recent Features Section -->
            <div class="bg-gray-800 rounded-lg shadow p-6 mt-8">
                <h3 class="text-xl font-bold text-gray-200">Recent Features</h3>
                <ul class="mt-4 space-y-4">
                    <li class="flex items-start">
                        <span class="text-blue-400 mr-3">📌</span>
                        <p class="text-gray-400">Like and Comment on post in real time with AJAX</p>
                    </li>
                    <li class="flex items-start">
                        <span class="text-green-400 mr-3">✨</span>
                        <p class="text-gray-400">Integration with external APIs like Quotes using Service Container</p>
                    </li>
                    <li class="flex items-start">
                        <span class="text-yellow-400 mr-3">🌦</span>
                        <p class="text-gray-400">Dynamic weather updates for your city</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 py-4 mt-12">
        <div class="text-center text-gray-400">
            © 2024 My Social Media App. All rights reserved.
        </div>
    </footer>
</body>
</html>