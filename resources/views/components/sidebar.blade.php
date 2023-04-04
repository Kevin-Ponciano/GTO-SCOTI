<aside class="main-sidebar sidebar-light-blue shadow">
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
                @if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'manager'))
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link">
                            <i class="nav-icon bi bi-house-fill"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->hasTeamPermission(Auth::user()->currentTeam, 'managerTasks'))
                <li class="nav-item">
                    <a href="#" onclick="$('#new_task_modal').modal('show')"
                       class="nav-link">
                        <i class="nav-icon bi bi-calendar-plus-fill"></i>
                        <p>Nova Tarefa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('teams.create')}}" class="nav-link">
                        <i class="nav-icon bi bi-building-fill-add"></i>
                        <p>Cadastrar Empresa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users')}}" class="nav-link">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Colaboradores</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('new-user')}}" class="nav-link">
                        <i class="nav-icon bi bi-person-plus-fill"></i>
                        <p>Cadastrar Colaborador</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('tasks')}}" class="nav-link">
                        <i class="nav-icon bi bi-list"></i>
                        <p>Tarefas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('tasks-scheduled')}}" class="nav-link">
                        <i class="nav-icon bi bi-clock-fill"></i>
                        <p>Tarefas Agendadas</p>
                    </a>
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
