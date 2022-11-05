@php use App\Models\User; @endphp
<div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><b>Nova Tarefa</b></h6>
            </div>
            <div class="modal-body">

                <form id="form-calendar" action="{{route('storeTask')}}" method="post">
                    {!! csrf_field() !!}

                    <div class="form-floating px-2">
                        <label for="title">Título</label>
                        <input class="form-control shadow" name="title" id="title">
                    </div>

                    <div class="form-floating px-2 py-1">
                        <label for="description">Descrição</label>
                        <textarea class="form-control shadow" name="description" id="description" rows="2"></textarea>
                    </div>

                    <div class="form-floating px-2 py-1">
                        <label for="priority">Prioridade</label>
                        <select class="form-control shadow" name="priority" id="priority" required>
                            <option value="Baixa" selected>Baixa</option>
                            <option value="Média">Média</option>
                            <option value="Alta">Alta</option>
                        </select>
                    </div>

                    <div class="form-floating px-2 py-1">
                        <label for="user_id">Responsável</label>
                        <select class="form-control shadow" name="user_id" id="user_id">
                            @php($users = User::all())
                            @foreach($users as $user)
                                <option value="{{$user->id}}"
                                        @if(Auth::user()->id==$user->id)selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-floating p-2">
                        <label for="deadline">Prazo</label>
                        <input type="date" class="form-control shadow" name="deadline" id="deadline">
                        <input name="date_create" id="date_create" hidden>
                        <script>
                            let dtToday = new Date()
                            let month = dtToday.getMonth() + 1
                            let day = dtToday.getDate()
                            let year = dtToday.getFullYear()

                            if (month < 10)
                                month = '0' + month.toString();
                            if (day < 10)
                                day = '0' + day.toString();

                            let maxDate = year + '-' + month + '-' + day;

                            $('#deadline').attr('min', maxDate)
                            $('#date_create').val(maxDate)

                        </script>
                    </div>
                    <div class="modal-footer py-0">
                        <button type="submit" class="btn btn-primary" id="createTask">Criar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
