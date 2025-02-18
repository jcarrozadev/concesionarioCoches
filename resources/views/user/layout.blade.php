<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/user.css">
    @stack('style')

</head>
<body>

    @include('user.components.header')

    @yield('content')

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
    @stack('js')
</body>
</html>