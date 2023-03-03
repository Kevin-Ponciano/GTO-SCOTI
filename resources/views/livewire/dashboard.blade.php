<div class="container-fluid">
    <div class="row">
        @foreach([
            ['Minhas Tarefas', 'ion ion-person', url('tarefas?userFilter='.Auth::user()->id), $userTasksLength],
            ['Minhas tarefas vencidas', 'ion ion-clock', url('tarefas?userFilter='.Auth::user()->id.'&statusFilter=Expirado'), $userTasksExpiredLength],
            ['Tarefas Abertas', 'ion ion-person-stalker', route('tasks'), $allTasksOpen],
        ] as $card)
            <div class="col-lg-3 col-6">
                <div class="small-box {{ $card[3] == 0 ? 'bg-secondary' : 'bg-'.($card[0] == 'Minhas tarefas vencidas' ? 'warning' : 'success') }}">
                    <div class="inner">
                        <h3>{{ $card[3] }}</h3>
                        <p>{{ $card[0] }}</p>
                    </div>
                    <div class="icon">
                        <i class="{{ $card[1] }}"></i>
                    </div>
                    <a href="{{ $card[2] }}" class="small-box-footer">Detalhes <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
