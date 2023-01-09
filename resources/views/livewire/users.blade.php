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
            <th class="col-sm-1">Código</th>
            <th>Nome</th>
            <th>Função</th>
            <th>Empresa</th>
            <th class="col-sm-1"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->current_team_id}}</td>
                <td>
                    <button class="btn btn-dark p-1" style="font-size: 12px">DETALHES</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
