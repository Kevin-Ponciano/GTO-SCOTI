@php
    use App\Http\Livewire\Users;
@endphp
<div>
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f4f6f9;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgb(244, 246, 249), rgb(197, 201, 211));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgb(244, 246, 249), rgb(197, 201, 211))
        }
    </style>

    <div class="row g-0">
        <div class="col-md-4 gradient-custom text-center text-black  font-bold"
             style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
            <img class="img-fluid my-5 rounded-full"
                 src="{{$profile_photo_url}}"
                 alt="Avatar" style="width: 80px;display: inline;"/>
            <h5>{{__($name)}}</h5>
            <p>{{$roleName}}</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <input value="{{$email}}" name="email" hidden>

                <button type="submit" class="btn btn-outline-dark font-extralight">Redefinir senha</button>
            </form>
        </div>
        <div class="col-md-8">
            <div class="card-body p-4">
                <h6>{{__('Information')}}</h6>
                <hr class="mt-0 mb-4">
                <div class="col pt-1">
                    <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <p class="text-muted">{{$email}}</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Phone</h6>
                        <p class="text-muted">123 456 789</p>
                    </div>
                </div>
                <h6>{{__('Team Manager')}}</h6>
                <hr class="mt-0 mb-1">
                <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <select class="form-control"
                                wire:model="enterpriseId">
                            @foreach($enterprises as $enterprise)
                                <option value="{{$enterprise->id}}">{{$enterprise->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 mb-3">
                        <select class="form-control"
                                wire:model="role">
                            @foreach($roles as $role)
                                <option value="{{$role->key}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mx-auto">
                        <button type="button"
                                class="btn btn-outline-info"
                                wire:click="store({{$user}})">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <script>
            success_info('{{session('success')}}')
        </script>
    @endif
</div>





