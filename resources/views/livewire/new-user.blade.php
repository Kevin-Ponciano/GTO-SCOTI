<div>
    @if (session()->has('success'))
        <script>
            success_info('{{session('success')}}')
        </script>
    @endif

    <div class="form-floating px-2">
        <label for="name">Nome</label>
        <input
            class="form-control shadow" wire:model="name">
    </div>

    <div class="form-floating px-2 py-1">
        <label for="e-mail">E-mail</label>
        <input
            class="form-control shadow" wire:model="email">
    </div>

    <div class="form-floating px-2 py-1">
        <label for="password">Senha</label>
        <input
            class="form-control shadow" wire:model="password" type="password" required>
    </div>

    <div class="form-floating px-2 py-1">
        <label for="enterprise">Empresa</label>
        <select class="form-control shadow" wire:model="enterpriseId">
            @foreach($enterprises as $enterprise)
                <option value="{{$enterprise->id}}">{{$enterprise->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-floating px-2 py-1" id="role_input">
        <label for="role">Função</label>
        <select class="form-control shadow" wire:model="role">
            @foreach($roles as $role)
                <option value="{{$role->key}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="modal-footer py-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button wire:click="create()" type="button" class="btn btn-primary">
            Criar
        </button>
    </div>
</div>
