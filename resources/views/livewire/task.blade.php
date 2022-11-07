<div class="col-12">
    <style>
        td,th{
            text-align: center;
        }
    </style>
    @if (session()->has('task-create'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
            })

            let notificacion = (info) => {
                Toast.fire({
                    icon: 'success',
                    title: info,
                    html: "<a href='{{route('task_detail', $task_id)}}'> Visualizar Tafera</a>"
                })
            }
            notificacion('{{session('task-create')}}');
        </script>
    @endif
    <button wire:click="create()" class="btn btn-dark font-bold py-z2 px-4 rounded my-3">
        Nova Tarefa
    </button>
    <table id="table" class="table table-sm table-bordered table-secondary table-striped table-hover">
        <thead class="bg-dark rounded items-center">
        <tr>
            <th>Título</th>
            <th>Prioridade</th>
            <th>Prazo</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td><a href="{{route('task_detail',$task->id)}}">{{$task->title}}</a></td>
                <td>{{$task->priority}}</td>
                <td>{{$task->deadline}}</td>
                <td>{{$task->status}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($isOpen)
        @include('livewire.new-task-modal')
    @endif
</div>

