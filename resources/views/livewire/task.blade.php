<div class="col-12">
    @if (session()->has('task-create'))
        <script>
            notificacion('{{ session('task-create') }}');
        </script>
    @endif
    <button wire:click="create()" class="btn btn-dark font-bold py-2 px-4 rounded my-3">
        Nova Tarefa
    </button>
    <table id="table" class="table table-bordered">
        <thead>
        <tr>
            <th>Título</th>
            <th>Prioridade</th>
            <th>Prazo</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{$task->title}}</td>
                <td>{{$task->priority}}</td>
                <td>{{$task->deadline}}</td>
                <td>
                    <button>Detalhes</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        @if($isOpen)
            @include('livewire.new-task-modal')
        @endif
</div>

