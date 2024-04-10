<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Подключение CSS стилей -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Ваши дополнительные стили здесь */
    </style>
</head>
<body>
<div class="sidebar">
    <!-- Ваша боковая панель здесь -->
</div>

<div class="content">
    @yield('content')
</div>
</body>
</html>
