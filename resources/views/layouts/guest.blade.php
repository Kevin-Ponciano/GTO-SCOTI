<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!--STYLES-->
    <link rel="stylesheet" href={{asset("adminLTE/plugins/fontawesome-free/css/all.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/dist/css/adminlte.min.css?v=3.2.0")}}>

    <!-- Tallwind css -->
    <link href="{{ asset('assets/css/flowbite-v1.6.3.css') }}" rel="stylesheet">

</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</div>
</body>

<script src={{asset("adminLTE/plugins/jquery/jquery.min.js")}}></script>
<script src={{asset("adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<script src={{asset("adminLTE/dist/js/adminlte.min.js?v=3.2.0")}}></script>
<script src="{{ asset('assets/js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
</html>
