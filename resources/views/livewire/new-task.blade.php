<div>
    <div class="form-floating px-2">
        <label for="title">Título @error('title')<span class="text-sm text-red">{{$message}}</span>@enderror</label>
        <input
            class="form-control shadow"
            wire:model="title">
    </div>

    <div class="form-floating px-2 py-1">
        <label for="description">Descrição</label>
        <textarea class="form-control shadow"
                  wire:model="description"
                  rows="2">
        </textarea>

    </div>

    <div class="form-floating px-2 py-1">
        <label for="priority">Prioridade</label>
        <select class="form-control shadow"
                wire:model="priority">
            <option value="Baixa">Baixa</option>
            <option value="Média">Média</option>
            <option value="Alta">Alta</option>
        </select>
    </div>

    <div class="form-floating px-2 py-1">
        <label for="userId">Responsável</label>
        <select class="form-control shadow" wire:model="userId">
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-floating p-2">
        <label for="deadline">Prazo  @error('deadline')<span class="text-sm text-red">{{$message}}</span>@enderror</label>
        <input type="date"
               class="form-control shadow deadline-class"
               wire:model="deadline">

        <script>
            dateTodayController = () => {
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
            }
            dateTodayController()
            window.addEventListener('dateTodayRefresh', event => {
                dateTodayController()
            })
        </script>
    </div>
    <div class="modal-footer py-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button wire:click="store()" type="button" class="btn btn-primary">
            Criar
        </button>
    </div>

    @if (session()->has('success'))
        <script>
            success_task_info('{{session('success')}}', {{$taskId}})
        </script>
    @endif
</div>

