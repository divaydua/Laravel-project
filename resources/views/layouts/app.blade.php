<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Management')</title>
    <style>
        /* General body and layout styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #3b5998;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #3b5998;
            color: white;
            padding: 10px 20px;
            text-align: center;
            margin-top: 20px;
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px 0;
            list-style: none;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a,
        .pagination span {
            display: block;
            padding: 8px 15px;
            background-color: #fff;
            color: #3b5998;
            border: 1px solid #ddd;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Active page style */
        .pagination .active a {
            background-color: #3b5998;
            color: white;
        }

        /* Disabled page style */
        .pagination .disabled a {
            background-color: #eee;
            color: #aaa;
        }

        /* Hover effect */
        .pagination a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>User Management</h1>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        <p>&copy; 2024 User Management</p>
    </div>
</body>
</html>