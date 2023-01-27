<div>
    <div class="py-0" style="padding-left: 77%">
        <div class="custom-switch custom-switch-off-success custom-switch-on-danger ">
            <input type="checkbox" wire:model="private" wire:click="label_private()"
                   class="custom-control-input" id="customSwitch3">
            <label class="custom-control-label" for="customSwitch3"
                   wire:model="isPrivate" id="label_private"> {{$isPrivate}}</label>
        </div>
    </div>
    <div class="form-floating p-2">
        <textarea class="form-control shadow" wire:model="comment" rows="5"></textarea>
    </div>


    <div class="modal-footer py-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button wire:click="store()" type="button" class="btn btn-primary" @if(!$comment) disabled @endif>
            Criar
        </button>
    </div>

    @if (session()->has('success'))
        <script>
            success_info('{{session('success')}}')
        </script>
    @endif
</div>
