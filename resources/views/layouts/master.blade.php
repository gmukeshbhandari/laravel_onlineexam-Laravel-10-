<!DOCTYPE html>
<html lang="en">
<head>
    <title> @yield('title','Online Examination System') </title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0c17971e93.js" crossorigin="anonymous"></script>
    {{-- Popper JS From https://floating-ui.com/docs/tutorial --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.1"></script> --}}

    {{-- https://floating-ui.com/docs/getting-started#umd or Popper JS --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.1"></script> --}}
    {{-- <!-- MDB https://mdbootstrap.com/docs/standard/getting-started/installation/ -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet"/> --}}
    {{--     
        Offline Bootstrap and CSS file (downloaded file locate in public directory of this laravel project)
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <script src="{{ asset('js/bootstrap.min.js') }}"> </script>
        <script src="{{ asset('js/jquery/jquery.min.js') }}"> </script>
    --}}
    {{-- https://driverjs.com/docs/installation --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/> --}}

    @yield('headsection')
    <link rel="stylesheet" href="{{ asset('css/custom/flipclock.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/profilesidebar.css') }}">
    <script src="{{ asset('js/custom/imageupload.js') }}"> </script>
    <script src="{{ asset('js/jquery/jquery.countdown.js') }}"> </script>
    <script src="{{ asset('js/custom/flipclock.min.js') }}"> </script>
</head>
<body class="d-flex flex-column m-0 p-0 min-vh-100" style="background: #C0C0C0;">
        @if (in_array(Route::currentRouteName(), ['reset_email_sent','reset_password','home']))
        <div class="container-fluid d-flex flex-column justify-content-center align-items-center flex-grow-1" id="myexamidforfullscreen">
        @else
        <div class="container-fluid" style="margin-bottom: 10px">
        @endif
        @include('includes.jumbo')
        @include('includes.navbar')
            @yield('content')
        </div>
    @include('includes.footer')
    {{-- <!-- MDB https://mdbootstrap.com/docs/standard/getting-started/installation/ -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"> </script> --}}
</body>

</html>