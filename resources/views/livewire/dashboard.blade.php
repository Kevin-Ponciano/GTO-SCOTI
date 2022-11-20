<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box @if($user_tasks_length==0) bg-secondary @else bg-info @endif">
                <div class="inner">
                    <h3>{{$user_tasks_length}}</h3>
                    <p>Minhas Tarefas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{route('user-tasks')}}" class="small-box-footer">Detalhes <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box @if($user_tasks_expired_length==0) bg-secondary @else bg-warning @endif">
                <div class="inner">
                    <h3>{{$user_tasks_expired_length}}</h3>
                    <p>Minhas tarefas vencidas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clock"></i>
                </div>
                <a href="{{route('user-tasks')}}" class="small-box-footer">Detalhes <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box @if($all_tasks_open==0) bg-secondary @else bg-success @endif">
                <div class="inner">
                    <h3>{{$all_tasks_open}}</h3>
                    <p>Tarefas Abertas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="{{route('tasks')}}" class="small-box-footer">Detalhes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
