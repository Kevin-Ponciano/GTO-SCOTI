<div class="col-12 py-4">
    <style>
        td, th {
            text-align: center;
        }
    </style>
    <table id="table" class="table table-sm table-bordered table-secondary table-striped table-hover m-0">
        <thead class="bg-dark rounded items-center">
        <tr>
            <th>Empresa</th>
            <th class="col-sm-1"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($enterprises as $enterprise)
            <tr>
                <td>{{$enterprise->name}}</td>
                <td><a href="{{route('teams.show', $enterprise->id) }}">
                        <button class="btn btn-dark p-1" style="font-size: 12px">DETALHES</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

