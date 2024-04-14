<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Подключение CSS стилей -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="error-message">{{ $error }}</div>
    @endforeach
@endif

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

</body>
</html>
