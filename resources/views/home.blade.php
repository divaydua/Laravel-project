<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .navbar {
            background-color: #3b5998;
            color: white;
            padding: 1em 2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 1em;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .container {
            display: flex;
            margin: 1em;
        }
        .main-content {
            flex: 3;
            margin-right: 1em;
            padding: 1em;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            flex: 1;
            padding: 1em;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .post {
            border-bottom: 1px solid #ddd;
            padding: 1em 0;
        }
        .post h3 {
            margin: 0;
            color: #333;
        }
        .post p {
            margin: 0.5em 0;
            color: #555;
        }
        .comments {
            margin-top: 1em;
            padding-left: 1em;
            border-left: 3px solid #eee;
        }
        .comments p {
            margin: 0.5em 0;
        }
        .users-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .users-list li {
            margin: 0.5em 0;
            padding: 0.5em;
            background: #f9f9f9;
            border-radius: 4px;
            text-align: center;
        }
        .users-list li:hover {
            background: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>SocialNet</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/profile">Profile</a>
            <a href="/logout">Logout</a>
        </nav>
    </div>

    <div class="container">
        <!-- Main Content -->
        <div class="main-content">
            <h2>Posts</h2>

            <div class="post">
                <h3>John Doe</h3>
                <p>Just got back from a fantastic hike! The views were amazing.</p>
                <div class="comments">
                    <p><strong>Jane Smith:</strong> Wow, that sounds awesome!</p>
                    <p><strong>Mark Johnson:</strong> Share some pictures!</p>
                </div>
            </div>

            <div class="post">
                <h3>Jane Smith</h3>
                <p>Finally tried the new café in town. The coffee is amazing!</p>
                <div class="comments">
                    <p><strong>John Doe:</strong> I’ve been meaning to check it out!</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Users</h2>
            <ul class="users-list">
                <li>John Doe</li>
                <li>Jane Smith</li>
                <li>Mark Johnson</li>
                <li>Emily Davis</li>
                <li>Chris Brown</li>
            </ul>
        </div>
    </div>
</body>
</html>