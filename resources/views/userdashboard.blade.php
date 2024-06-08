<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title','User Dashboard - Online Examination System') </title>
    @yield('headsectiondashboard')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0c17971e93.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/custom/userdashboard.css') }}">
</head>
<body>
<div class="main">
    @include('userdashboard.navbar')
    <div class="contain">
        <div class="menu_container">
            @include('userdashboard.menu')
        </div>
        <div class="content_container">
            @yield('content')
        </div>  
    </div>
    @include('userdashboard.footer')
</div>
</body>
</html>