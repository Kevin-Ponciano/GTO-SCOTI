<x-app-layout>
    <div class="col-12">
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
                    <td><button>Detalhes</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
