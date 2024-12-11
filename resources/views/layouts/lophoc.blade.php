<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ URL::to('assets/css/lophoc.css') }}">
    
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>