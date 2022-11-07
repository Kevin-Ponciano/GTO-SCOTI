@php use App\Models\User; @endphp
<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline" style="padding-bottom: 8px">

                <div class="modal-header py-2">
                    <h5 class="modal-title"><b>Nova Tarefa</b></h5>
                </div>
                <form>
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
                        <button wire:click="store()" type="button" class="btn btn-primary">
                            Criar
                        </button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal()" onclick="">Cancelar</button>
                    </div>
                </form>
        </div>
    </div>
</div>
