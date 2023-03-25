<x-guest-layout>
    <body class="hold-transition login-page">
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif
    <a href="/">
        <img src="{{asset("assets/images/logomarca.png")}}" class="h-24 mb-2" alt="logo">
    </a>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>GTO</b></a>
                <p>Gestão de Tarefas Online</p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Faça login para iniciar sua sessão</p>
                <x-jet-validation-errors class="mb-4"/>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input id="email" type="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Email" name="email"
                               value="{{old('email')}}" required autofocus>
                    </div>
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input id="password" type="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               name="password" placeholder="Password"
                               required autocomplete="current-password">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="flex items-center">
                                <x-jet-checkbox name="remember" id="remember_me"/>
                                <label for="remember_me"
                                       class="ml-2 mb-0 text-xs text-gray-900 dark:text-gray-300">{{__('Remember Me')}}</label>
                            </div>
                        </div>
                        <div class="col-2 px-4">
                            <button type="submit"
                                    class="text-white bg-blue-600 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Entrar
                            </button>
                        </div>

                    </div>
                </form>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                {{--                <p class="mb-0">--}}
                {{--                    <a href="#" class="text-center">Register a new membership</a>--}}
                {{--                </p>--}}
            </div>

        </div>
    </div>
    </body>

</x-guest-layout>

