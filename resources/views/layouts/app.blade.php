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

    <!-- STYLES -->
    <link rel="stylesheet" href={{asset("adminLTE/plugins/fontawesome-free/css/all.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/dist/css/adminlte.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/plugins/summernote/summernote-bs4.min.css")}}>
    <link rel="stylesheet" href="{{asset("adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")}}">
    <link rel="stylesheet" href="{{asset("//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css")}}">


    <script src={{asset("https://code.jquery.com/jquery-3.6.1.js")}}></script>

    <!-- Tallwind css -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@stack('modals')

<div class="wrapper">

    {{--    <<div class="preloader flex-column justify-content-center align-items-center">--}}
    {{--        <img class="animation__shake" src="{{asset('adminLTE/dist/img/logo.png')}}" alt="logo" height="60" width="60">--}}
    {{--    </div>--}}

    <nav class="main-header navbar navbar-expand navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Dashboard</a>
            </li>
        </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link">
            <img src="{{asset('adminLTE/dist/img/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">GTO</span>
        </a>

        <div class="sidebar">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                    style="padding-left: 10px">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                         alt="{{ Auth::user()->name }}"/>

                </div>
            @endif
            <div class="user-panel pb-1 mb-3 d-flex">
                <div class="info px-3">
                    <a href="{{route('profile.show')}}" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('tasks')}}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Minhas Tarefas</p>
                        </a>
                    </li>

{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-book"></i>--}}
{{--                            <p>Tutorial</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-edit"></i>--}}
{{--                            <p>Cadastro<i class="fas fa-angle-left right"></i></p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="#" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Tarefas Recorrentes</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="#" class="nav-link">--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Usuário</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}

{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link" onclick="">--}}
{{--                            <i class="nav-icon fas fa-chart-pie"></i>--}}
{{--                            <p>Gestor</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" id="logout">
                            @csrf
                        </form>
                        <a href="#" class="nav-link" onclick="$('#logout').submit()">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Sair</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <main class="content" id="main">
            {{ $slot }}
        </main>
    </div>



    <footer class="main-footer">
        <strong>Copyright &copy; 2022 <a href="#">GTO - Gestão de Tarefas Online</a> - </strong>
        Todos os direitos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 2.0
        </div>
    </footer>
</div>

@stack('modals')
@livewireScripts

<script src={{asset("adminLTE/plugins/jquery-ui/jquery-ui.min.js")}}></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src={{asset("adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<script src={{asset("adminLTE/plugins/summernote/summernote-bs4.min.js")}}></script>
<script src={{asset("adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
<script src={{asset("adminLTE/dist/js/adminlte.js")}}></script>
<script src={{asset("adminLTE/plugins/sweetalert2/sweetalert2.min.js")}}></script>
<script src={{asset('assets/js/ajaxPage.js')}}></script>
<script src={{asset('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js')}}></script>

<script>
    $(document).ready(function () {
        let dataTable = $('#table').DataTable({
            stateSave: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            },
            info: false,
            retrieve: true,
        })
    })

</script>

</body>
</html>
