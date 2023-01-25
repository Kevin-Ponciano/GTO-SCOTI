@php
    use App\Http\Livewire\Users;
@endphp
<div class="col-12">
    <style>
        td, th {
            text-align: center;
        }
    </style>
    <button class="btn btn-dark font-bold px-4 rounded my-3"
            wire:click="$emit('initVariables')"
            onclick="$('#new_user_modal').modal('show')">Novo Usúario
    </button>

    <table id="table" class="table table-sm table-bordered table-secondary table-striped table-hover m-0">
        <thead class="bg-dark rounded items-center">
        <tr>
            <th class="col-sm-1">Código</th>
            <th class="col-sm-3">Nome</th>
            <th class="col-sm-3">Empresa</th>
            <th class="col-sm-1">Função</th>
            <th class="col-sm-1"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->teams[0]->name}}</td>
                <td>{{$user->teamRole($user->currentTeam)->name}}</td>
                <td>
                    <button class="btn btn-dark p-1" style="font-size: 12px"
                            wire:click="$emit('edit',{{$user->id}})"
                            onclick="$('#edit_user_modal').modal('show')">Editar
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id='new_user_modal' tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"><b>Novo Usuário</b></h6>
                </div>
                <div class="modal-body">
                    <livewire:new-user/>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id='edit_user_modal' tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"><b>Editar Usuário</b></h6>
                </div>
                <div class="modal-body">
                    <livewire:edit-user/>
                </div>
            </div>
        </div>
    </div>
</div>
