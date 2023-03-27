@php
    use app\http\Livewire\Tasks;
    use Carbon\Carbon;
    use App\Models\User;
@endphp
{{--<section class="content-header">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row mb-2">--}}
{{--            <div class="col-sm-6">--}}
{{--            </div>--}}
{{--            <div class="col-sm-6">--}}
{{--                <ol class="breadcrumb float-sm-right">--}}
{{--                    <li class="breadcrumb-item"><a href="{{route('tasks')}}">Voltar</a></li>--}}
{{--                    <li class="breadcrumb-item active">Project Detail</li>--}}
{{--                </ol>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<div class="mt-2">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">#{{$task->id}} - {{$task->title}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-4 order-2 order-md-1">
                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i>Descrição</h3>
                        <p id="description_field" class="text-muted"
                           style="overflow:hidden;white-space:nowrap;text-overflow: ellipsis">{{$task->description}}</p>
                        <script>
                            let show = true
                            $('#description_field').click(function () {
                                if (show) {
                                    $(this).css('white-space', 'break-spaces')
                                    show = false
                                } else {
                                    $(this).css('white-space', 'nowrap')
                                    show = true
                                }

                            })
                        </script>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Responsável
                                <b class="d-block">{{$userName}}</b>
                            </p>
                            {{--                        <p class="text-sm">Empresa--}}
                            {{--                            <b class="d-block">Tony Chicken</b>--}}
                            {{--                        </p>--}}
                        </div>

                        {{--                    <h5 class="mt-5 text-muted">Status</h5>--}}
                        {{--                    <ul class="list-unstyled">--}}
                        {{--                        <li>--}}
                        {{--                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>--}}
                        {{--                                Functional-requirements.docx</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li>--}}
                        {{--                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li>--}}
                        {{--                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i>--}}
                        {{--                                Email-from-flatbal.mln</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li>--}}
                        {{--                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li>--}}
                        {{--                            <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>--}}
                        {{--                                Contract-10_12_2014.docx</a>--}}
                        {{--                        </li>--}}
                        {{--                    </ul>--}}
                        <div class="text-start mt-5 mb-3">
                            @if($task->situation == 'open')
                                <x-button-blue
                                    class="text-xs"
                                    onclick="$('#modal_comment').modal('show')">
                                    {{__('Comment')}}
                                </x-button-blue>
                                <x-button-red type="button"
                                              onclick="$('#finalize-confirm-modal').modal('show')">
                                    {{__('Finalize')}}
                                </x-button-red>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-8 order-1 order-md-2">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Prioridade</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{$task->priority}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Status</span>
                                        @php
                                            if($task->status == 'Em dia')
                                                $status_color = 'success';
                                            elseif ($task->status == 'Expirado' || $task->status == 'Finalizada')
                                                $status_color = 'danger';
                                            else
                                                $status_color = 'warning';

                                            $task->deadline = Carbon::createFromFormat("Y-m-d", $task->deadline)->format("d/m/y");
                                            $task->date_create = Carbon::createFromFormat("Y-m-d", $task->date_create)->format("d/m/y");
                                        @endphp
                                        <span class="info-box-number text-center text-muted mb-0">
                                            <span class="badge lg badge-{{$status_color}}">{{$task->status}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Criado - Prazo</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            {{$task->date_create}} - {{$task->deadline}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3 class="text-muted py-1"><b>Comentários</b></h3>
                                <div class="timeline">
                                    @foreach ($comments as $comment)
                                        @if ($comment->private == 1 && $comment->user_id == Auth::user()->id)
                                            @php
                                                $comment_time = Carbon::createFromFormat("Y-m-d H:i:s", $comment->date_time_create)->format("h:i A");
                                                $comment_date = Carbon::createFromFormat("Y-m-d H:i:s", $comment->date_time_create)->format("d M. Y");
                                            @endphp
                                            <div>
                                                <i class="fas fa-circle bg-red"></i>
                                                <div class="timeline-item">
                                                    <span class="time">{{$comment_time.' '}}<i class="fas fa-clock"></i><br>{{$comment_date}}</span>
                                                    {{--Ir para o perfil da pessora--}}
                                                    <div class="timeline-body">
                                                        <div class="user-block">
                                                            @php
                                                                $user = User::find($comment->user_id);
                                                            @endphp
                                                            <img class="h-10 w-10 rounded-full object-cover"
                                                                 src="{{$user->profile_photo_url}}"/>
                                                            <span class="username">
                                                                <a href="#">{{$comment->user_name}}</a>
                                                            </span>
                                                            <span class="description">Privado</span>
                                                        </div>
                                                    </div>
                                                    <div class="post clearfix py-1  m-1"></div>
                                                    <div class="timeline-footer py-1">
                                                        {{$comment->comment}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($comment->private == 0)
                                            @php
                                                $comment_time = Carbon::createFromFormat("Y-m-d H:i:s", $comment->date_time_create)->format("h:i A");
                                                $comment_date = Carbon::createFromFormat("Y-m-d H:i:s", $comment->date_time_create)->format("d M. Y");
                                            @endphp
                                            <div>
                                                <i class="fas fa-circle bg-dark"></i>
                                                <div class="timeline-item">
                                                    <span class="time">{{$comment_time.' '}}<i class="fas fa-clock"></i><br>{{$comment_date}}</span>
                                                    {{--Ir para o perfil da pessora--}}
                                                    <div class="timeline-body">
                                                        <div class="user-block">
                                                            @php
                                                                $user = User::find($comment->user_id);
                                                            @endphp
                                                            @if($user != null)
                                                                <img class="h-10 w-10 rounded-full object-cover"
                                                                 src="{{$user->profile_photo_url}}"/>
                                                                <span class="username">
                                                                <a href="#">{{$comment->user_name}}</a>
                                                            </span>
                                                            @else
                                                                <img class="h-10 w-10 rounded-full object-cover"
                                                                 src="{{asset('assets/images/peaple.png')}}"/>
                                                                <span class="username">
                                                                <a href="#">{{__('Deleted user')}}</a>
                                                            @endif
                                                            <span class="description">comentou</span>
                                                        </div>
                                                    </div>
                                                    <div class="post clearfix py-1  m-1"></div>
                                                    <div class="timeline-footer py-1">
                                                        {{$comment->comment}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal_comment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <livewire:new-comment/>
        </div>
    </div>

    <div class="modal fade py-5" id="finalize-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            {{__('Are you sure you want to finish the task ')}}<b>{{$task->id}}</b>?</h3>
                        <x-button-red class="text-md py-2.5"
                                      wire:click="finalizeTask({{$task->id}})">
                            {{__('Finalize')}}
                        </x-button-red>
                        <x-button-dark data-dismiss="modal">{{__('Cancel')}}</x-button-dark>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

