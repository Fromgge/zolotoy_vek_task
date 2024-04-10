<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #333;
            color: #fff;
            width: 200px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 100px;
            overflow-y: auto;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #555;
        }

        .sidebar ul li:last-child {
            border-bottom: none;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar ul li a:hover {
            color: #fff;
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <ul>
        <li><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
        <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <li><a href="{{ route('categories.index') }}">Back to website</a></li>
    </ul>

</div>
</body>
</html>
