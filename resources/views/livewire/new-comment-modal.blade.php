<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline" style="margin-bottom: 260px">

            <div class="modal-header">
                <h5 class="modal-title"><b>Adicionar Comentário</b></h5>
            </div>
            <form>
                <div class="form-floating px-2">
                    <label for="title">Comentário</label>
                    <input
                        class="form-control shadow" wire:model="comment">
                </div>
                <div class="text-end py-2" style="padding-left: 400px;">
                    <div class="custom-switch custom-switch-off-success custom-switch-on-danger">
                        <input type="checkbox" wire:model="private" wire:click="label_private()"
                               class="custom-control-input" id="customSwitch3">
                        <label class="custom-control-label" for="customSwitch3"
                               wire:model="isPrivate" id="label_private">{{$isPrivate}}</label>
                    </div>
                </div>
                <div class="modal-footer py-0">
                    <button wire:click="store()" type="button" class="btn btn-primary">
                        Criar
                    </button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()">Cancelar</button>
                </div>
                <script>
                    let isPrivate = true
                    $('#label_privates').click(function (){
                        if(isPrivate){
                            $(this).html('Privado')
                            isPrivate = false
                        }else{
                            $(this).html('Publico')
                            isPrivate = true
                        }
                    })
                </script>
            </form>

        </div>
    </div>
</div>
