@php
    use App\Models\User;
    use app\http\Livewire\Tasks;
    use Carbon\Carbon;
@endphp
<div>
    <div class="col-12">
        <style>
            td, th {
                text-align: center;
            }
        </style>

        <button class="btn btn-dark font-bold px-4 rounded my-3" onclick="$('#modal').modal('show')">Nova Tarefa
        </button>

        <table id="table" class="table table-sm table-bordered table-secondary table-striped table-hover m-0">
            <thead class="bg-dark rounded items-center">
            <tr>
                <th>Título</th>
                <th>Prioridade</th>
                <th>Prazo</th>
                <th>Status</th>
                @if(Route::current()->uri == 'tarefas')
                    <th class="col-sm-1">Responsável</th>
                @endif
                <th class="col-sm-1"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                @php
                    $task->status = Tasks::status_controller($task->deadline);
                    if($task->status == 'Em dia')
                        $status_color = 'success';
                    elseif ($task->status == 'Expirado')
                        $status_color = 'danger';
                    elseif ($task->status == 'Expira Hoje')
                        $status_color = 'warning';
                    else
                        $status_color = 'warning';
                    //$task->deadline = Carbon::createFromFormat("Y-m-d", $task['deadline'])->format("d/m/Y");
                @endphp

                <tr>
                    <td>{{$task->title}}</td>
                    <td>{{$task->priority}}</td>
                    <td>{{$task->deadline}}</td>
                    <td><span class="badge badge-{{$status_color}}">{{$task->status}}</span></td>
                    @if(Route::current()->uri == 'tarefas')
                        @php
                            $user_name =  User::find($task->user_id);
                            $user_name = $user_name->name;
                        @endphp
                        <td>{{$user_name}}</td>
                    @endif
                    <td><a href="{{route('task_detail',$task->id)}}">
                            <button class="btn btn-dark p-1" style="font-size: 12px">DETALHES</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>



