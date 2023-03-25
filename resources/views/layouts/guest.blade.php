<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href={{asset('logo.png')}}>

    <!-- Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!--STYLES-->
    @vite([
        'resources/adminLTE/plugins/fontawesome-free/css/all.min.css',
        'resources/adminLTE/dist/css/adminlte.css'
    ])
{{--    <link rel="stylesheet" href={{asset("adminLTE/plugins/fontawesome-free/css/all.min.css")}}>--}}
{{--    <link rel="stylesheet" href={{asset("adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>--}}
{{--    <link rel="stylesheet" href={{asset("adminLTE/dist/css/adminlte.min.css?v=3.2.0")}}>--}}

    <!-- Tallwind css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</div>
</body>

{{--<script src={{asset("adminLTE/plugins/jquery/jquery.min.js")}}></script>--}}
{{--<script src={{asset("adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>--}}
{{--<script src={{asset("adminLTE/dist/js/adminlte.min.js?v=3.2.0")}}></script>--}}

</html>
