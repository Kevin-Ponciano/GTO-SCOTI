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
    <link rel="stylesheet" href={{asset("adminLTE/plugins/fontawesome-free/css/v4-shims.min.css")}}>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href={{asset("adminLTE/dist/css/adminlte.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/plugins/summernote/summernote-bs4.min.css")}}>
    <link rel="stylesheet" href="{{asset("adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")}}">
    <link rel="stylesheet" href="{{asset("//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css")}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <script src={{asset("https://code.jquery.com/jquery-3.6.1.js")}}></script>

    <!-- Tallwind css -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <style>
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background-color: #6c757d;
            color: #fff;
        }

        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active:hover {
            background-color: rgba(108, 117, 125, 0.5);
        }
    </style>

    @livewireStyles
</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
@stack('modals')
@php
    if (Auth::user()->currentTeam==null){
         abort(406);
    }
    $isAdmin = Auth::user()->hasTeamRole(Auth::user()->currentTeam,'admin');
    $isManager = Auth::user()->hasTeamRole(Auth::user()->currentTeam,'manager');
    $team = Auth::user()->teamRole(Auth::user()->currentTeam);
@endphp
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
                <a href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto ">
            <li class="nav-item px-2">
                <button class="btn btn-outline-dark font-bold px-4 rounded btn-xs"
                        onclick="$('#modal').modal('show')">Nova Tarefa
                </button>
            </li>
            <li class="nav-item px-2">
                <a href="@if($isManager) {{route('teams.show', Auth::user()->current_team_id)}} @else #@endif">
                    <div class="text-muted px-4 text-bold text-uppercase">
                        {{Auth::user()->currentTeam->name}}
                        <p class="text-sm-center" style="font-size: 10px">{{$team->name}}</p>
                    </div>

                </a>
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
                    <a href="{{route('profile.show')}}">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                             alt="{{ Auth::user()->name }}"></a>

                </div>
            @endif
            <div class="user-panel pb-1 mb-3 d-flex">
                <div class="info px-3">
                    <a href="{{route('profile.show')}}" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            {{--            <div class="form-inline">--}}
            {{--                <div class="input-group" data-widget="sidebar-search">--}}
            {{--                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"--}}
            {{--                           aria-label="Search">--}}
            {{--                    <div class="input-group-append">--}}
            {{--                        <button class="btn btn-sidebar">--}}
            {{--                            <i class="fas fa-search fa-fw"></i>--}}
            {{--                        </button>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('user-tasks')}}" class="nav-link">
                            <i class="nav-icon  fa bi-person-lines-fill"></i>
                            <p>Minhas Tarefas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tasks')}}" class="nav-link">
                            <i class="nav-icon far fa-list-alt"></i>
                            <p>Tarefas</p>
                        </a>
                    </li>

                    {{--                                        <li class="nav-item">--}}
                    {{--                                            <a href="#" class="nav-link">--}}
                    {{--                                                <i class="nav-icon fas fa-book"></i>--}}
                    {{--                                                <p>Tutorial</p>--}}
                    {{--                                            </a>--}}
                    {{--                                        </li>--}}

                    {{--                                        <li class="nav-item">--}}
                    {{--                                            <a href="#" class="nav-link">--}}
                    {{--                                                <i class="nav-icon fas fa-edit"></i>--}}
                    {{--                                                <p>Cadastro<i class="fas fa-angle-left right"></i></p>--}}
                    {{--                                            </a>--}}
                    {{--                                            <ul class="nav nav-treeview">--}}
                    {{--                                                <li class="nav-item">--}}
                    {{--                                                    <a href="#" class="nav-link">--}}
                    {{--                                                        <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                                        <p>Tarefas Recorrentes</p>--}}
                    {{--                                                    </a>--}}
                    {{--                                                </li>--}}
                    {{--                                                <li class="nav-item">--}}
                    {{--                                                    <a href="#" class="nav-link">--}}
                    {{--                                                        <i class="far fa-circle nav-icon"></i>--}}
                    {{--                                                        <p>Usuário</p>--}}
                    {{--                                                    </a>--}}
                    {{--                                                </li>--}}
                    {{--                                            </ul>--}}

                    <li class="nav-item @if(!$isManager) d-none @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Gestor<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class=" nav-item @if(!$isAdmin) d-none @endif ">
                                <a href="" class="nav-link">
                                    <i class="far bi-building-fill-gear nav-icon"></i>
                                    <p>Empresas<i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class=" nav-item">
                                        <a href="{{ route('enterprise') }}" class="nav-link">
                                            <i class="far bi-gear-fill nav-icon"></i>
                                            <p>Gerenciar</p>
                                        </a>
                                    </li>
                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Visualização de Empresa Atual
                                    </div>
                                    @foreach (Auth::user()->allTeams() as $team)
                                        <li class="nav-item">
                                            <a href="#"
                                               class="nav-link team @if (Auth::user()->isCurrentTeam($team)) active @endif">
                                                <i class="far bi-building-fill-gear nav-icon"></i>
                                                <p>{{$team->name}}</p>
                                            </a>
                                            <form id="switch_team" method="POST"
                                                  action="{{ route('current-team.update') }}"
                                                  x-data>
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="team_id" value="{{$team->id}}">
                                            </form>
                                            @endforeach
                                            <script>
                                                $('.nav-link.team').on('click', function () {
                                                    $(this).next().submit()
                                                })
                                            </script>
                                        </li>
                                </ul>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('users')}}" class="nav-link">
                                    <i class="far bi-people-fill nav-icon"></i>
                                    <p>Usuários</p>
                                </a>
                            </li>
                            <li class="nav-item @if(!$isManager || $isAdmin) d-none @endif">
                                <a href="{{route('teams.show', Auth::user()->current_team_id)}}" class="nav-link">
                                    <i class="far bi-person-add nav-icon"></i>
                                    <p>Vincular Funcionário</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <script>
                        let url = window.location;
                        let nav = $('ul.nav a[href="' + url + '"]').addClass('active')
                    </script>
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

    <div class="modal fade" id='modal' tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"><b>Nova Tarefa</b></h6>
                </div>
                <div class="modal-body">
                    <livewire:new-task/>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer" style="font-size: 12px">
        <strong>Copyright &copy; 2022 <a href="https://github.com/Kevin-Ponciano/GTO-LARAVEL">GTO - Gestão de Tarefas Online</a> - </strong>
        Todos os direitos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versão</b> 0.4.1
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
    window.addEventListener('closeModal', event => {
        $('#modal').modal('hide')
        $('#modal_comment').modal('hide')
        $('#new_user_modal').modal('hide')
        $('#edit_user_modal').modal('hide')
    })
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,

    })

    let success_task_info = (info, task_id) => {
        Toast.fire({
            icon: 'success',
            title: info,
            html: "<a href=/tarefas/" + task_id + "> Visualizar Tafera</a>"
        })
    }
    let success_info = (info) => {
        Toast.fire({
            icon: 'success',
            title: info,
        })
    }

    let finished_task = (info) => {
        Toast.fire({
            icon: 'warning',
            title: info,
        })
    }
</script>
@if (session()->has('finished'))
    <script>
        finished_task('{{session('finished')}}')
    </script>
@endif
</body>
</html>
