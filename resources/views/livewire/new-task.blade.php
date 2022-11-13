@php use App\Models\User; @endphp
<div>
    @if (session()->has('success'))
        <script>
            success_task_info('{{session('success')}}', {{$task_id}})
        </script>
    @endif
    <div class="form-floating px-2">
        <label for="title">Título</label>
        <input
            class="form-control shadow" wire:model="title">
    </div>

    <div class="form-floating px-2 py-1">
        <label for="description">Descrição</label>
        <textarea class="form-control shadow" wire:model="description"
                  rows="2"></textarea>
    </div>

    <div class="form-floating px-2 py-1">
        <label for="priority">Prioridade</label>
        <select class="form-control shadow" wire:model="priority">
            <option value="Baixa">Baixa</option>
            <option value="Média">Média</option>
            <option value="Alta">Alta</option>
        </select>
    </div>

    <div class="form-floating px-2 py-1">
        <label for="user_id">Responsável</label>
        <select class="form-control shadow" wire:model="user_id">
            @php($users = User::all())
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-floating p-2">
        <label for="deadline">Prazo</label>
        <input type="date" class="form-control shadow deadline-class" wire:model="deadline">
        <input class="date-create-class" name="date_create" wire:model="date_create" hidden>
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

            $('input.form-control.shadow.deadline-class').attr('min', maxDate)
        </script>
    </div>
    <div class="modal-footer py-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancelar</button>
        <button wire:click="store()" type="button" class="btn btn-primary">
            Criar
        </button>
    </div>
</div>

