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

    <!-- STYLES -->
{{--    @vite([--}}
{{--        'resources/adminLTE/dist/css/adminlte.css',--}}
{{--        'resources/adminLTE/plugins/fontawesome-free/css/all.min.css',--}}
{{--        'resources/adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',--}}
{{--        'resources/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'--}}
{{--    ])--}}
    <link rel="stylesheet" href={{asset("adminLTE/plugins/fontawesome-free/css/all.min.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/dist/css/adminlte.css")}}>
    <link rel="stylesheet" href={{asset("adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
    <link rel="stylesheet" href="{{asset("adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")}}">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Jquery -->
    <script src={{asset("https://code.jquery.com/jquery-3.6.1.js")}}></script>


    <!-- Tallwind css -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--    <link href="{{ asset('assets/css/tailwind-v3.1.8.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/css/flowbite-v1.6.3.css') }}" rel="stylesheet">


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
<body
    class="hold-transition sidebar-mini @if(Route::current()->action['as'] != 'dashboard') sidebar-collapse @endif layout-fixed">
@stack('modals')
@php
    if (Auth::user()->currentTeam==null){
         abort(406);
    }
    $team = Auth::user()->currentTeam;
    $isAdminRole = $team->userHasPermission(Auth::user(), 'admin');
    $isManagerRole = $team->userHasPermission(Auth::user(), 'manager');
@endphp
@if(Route::current()->action['as'] == 'dashboard')
    <nav class="main-header navbar navbar-expand navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" id="t" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('dashboard')}}" class="nav-link">Dashboard</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto ">
            <li class="nav-item px-2">
                <button class="btn btn-outline-dark font-bold px-4 rounded btn-xs"
                        onclick="$('#new_task_modal').modal('show')">Nova Tarefa
                </button>
            </li>
            <li class="nav-item px-2">
                @if ($isAdminRole)
                    <x-jet-dropdown align="right" width="30">
                        <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                                <button class="text-muted px-4 text-bold text-uppercase bg-transparent">
                                    {{Auth::user()->currentTeam->name}}
                                    <i class="bi bi-caret-down-fill"></i>
                                </button>
                        </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-48">
                                <!-- Team Settings -->
                                <x-jet-dropdown align="right" style="right: 197px;top: -28px;width: 8rem;">
                                    <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm
                                            leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50
                                             hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                            <i class="bi bi-caret-left-fill" style="padding-right: 10px"></i>
                                        Gerenciar Equipes
                                    </button>
                                </span>
                                    </x-slot>
                                    <x-slot name="content">
                                        @foreach(Auth::user()->allTeams() as $item)
                                            <div>
                                                <!-- Team Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    <a class="hover:text-gray-900"
                                                       href={{ route('teams.show', $item->id) }}>
                                                        {{($item->name)}}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </x-slot>
                                </x-jet-dropdown>
                                <div class="border-t border-gray-100"></div>
                                <!--Change teams-->
                                <x-jet-dropdown align="right" style="right: 197px;top: -25px;width: 11rem">
                                    <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm
                                            leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50
                                             hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                            <i class="bi bi-caret-left-fill" style="padding-right: 10px"></i>
                                        Alterar Equipe
                                    </button>
                                </span>
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="block text-xs text-gray-400">
                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-jet-switchable-team :team="$team"/>
                                            @endforeach
                                        </div>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                @else
                    <a href="@if($isManagerRole) {{route('teams.show', Auth::user()->current_team_id)}} @else #@endif">
                        <div class="text-muted px-4 text-bold text-uppercase">
                            {{Auth::user()->currentTeam->name}}
                        </div>
                    </a>
                @endif

            </li>
        </ul>
    </nav>
@endif


<aside class="main-sidebar sidebar-light-blue shadow ">
    <a href="#" class="brand-link">
        <img src="{{asset('logo.png')}}"
             alt="Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8;">
        <span class="brand-text text-gray-700 text-md">{{config('app.name')}}</span>
    </a>

    <div class="sidebar">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <a href="{{route('profile.show')}}" class="brand-link" style="width: 234px">
                <img src="{{Auth::user()->profile_photo_url}}"
                     class="h-10 w-10 rounded-full object-cover"
                     alt="{{ Auth::user()->name }}"
                     style="display: inline;">
                <span class="brand-text text-gray-700 text-md"
                      style="padding-left: 7px">
                        {{ Auth::user()->name }}
                    {{--                    <p class="text-sm-left"--}}
                    {{--                       style="font-size: 10px">--}}
                    {{--                    {{Auth::user()->teamRole($team)->name}}--}}
                    {{--                    </p>--}}
                </span>
            </a>
        @endif

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
                    <a href="{{url('tarefas?userFilter='.Auth::user()->id)}}" class="nav-link">
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
                <li class="nav-item">
                    <a href="{{route('tasks-scheduled')}}" class="nav-link">
                        <i class="nav-icon far fa-clock"></i>
                        <p>Tarefas Agendadas</p>
                    </a>
                </li>
                @if($isAdminRole)
                    <li class="nav-item">
                        <a href="{{route('users')}}" class="nav-link">
                            <i class="far bi-people-fill nav-icon"></i>
                            <p>Usuários</p>
                        </a>
                    </li>
                @elseif($isManagerRole)
                    <li class="nav-item">
                        <a href="{{route('teams.show', Auth::user()->current_team_id).'#users-manager'}}"
                           class="nav-link">
                            <i class="far bi-person-add nav-icon"></i>
                            <p>Vincular Funcionário</p>
                        </a>
                    </li>
                @endif

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

<div class="content-wrapper py-1">
    <main class="content">
        {{ $slot }}
    </main>
</div>

<div class="modal fade" id='new_task_modal' tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:new-task/>
        </div>
    </div>
</div>

@if(Route::current()->action['as'] == 'dashboard')

    <footer class="main-footer" style="font-size: 12px">
        <strong>Copyright &copy; {{date('Y')}} <a href="https://github.com/Kevin-Ponciano/GTO-LARAVEL" target="_blank">GTO
                -
                Gestão de Tarefas
                Online</a> - </strong>
        Todos os direitos reservados.

        <p class="float-sm-right px-1"> Desenvolvido com <i class="bi bi-heart-fill"></i>
            por <a href="https://github.com/Kevin-Ponciano/" target="_blank">Kevin</a>
        </p>

        <div class="float-right d-none d-sm-inline-block">
            <a href="https://github.com/Kevin-Ponciano/GTO-LARAVEL" target="_blank">
                <b>Versão</b> 0.5.1 <i class="bi bi-github"></i>
            </a>
        </div>
    </footer>
@endif


@stack('modals')
@livewireScripts

<script src={{asset("adminLTE/plugins/jquery-ui/jquery-ui.min.js")}}></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src={{asset("adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<script src={{asset("adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
<script src={{asset("adminLTE/dist/js/adminlte.js")}}></script>
<script src={{asset("adminLTE/plugins/sweetalert2/sweetalert2.min.js")}}></script>
<script src={{asset("assets/js/jquery.mask.min.js")}}></script>
{{--<script src="{{asset('assets/js/app.js') }}" defer></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.js"></script>--}}


<script>
    window.addEventListener('closeModal', event => {
        $('#new_task_modal').modal('hide')
        $('#modal_comment').modal('hide')
        $('#new_user_modal').modal('hide')
        $('#edit_user_modal').modal('hide')
        $('#apply-filter').modal('hide')
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

{{--<script>--}}
{{--    // On page load or when changing themes, best to add inline in `head` to avoid FOUC--}}
{{--    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {--}}
{{--        document.documentElement.classList.add('dark');--}}
{{--    } else {--}}
{{--        document.documentElement.classList.remove('dark')--}}
{{--    }--}}
{{--</script>--}}
@if (session()->has('finished'))
    <script>
        finished_task('{{session('finished')}}')
    </script>
@endif
</body>
</html>
