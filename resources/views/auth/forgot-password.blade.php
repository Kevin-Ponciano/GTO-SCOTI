<x-guest-layout>
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>GTO</b></a>
                <p>Gestão de Tarefas Online</p>
            </div>
            <div class="card-body">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="block">
                        <x-jet-label for="email" value="{{ __('Email') }}"/>
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                     :value="old('email')" required autofocus/>
                    </div>
                    @if (session('status'))
                        <div class="font-medium text-xs text-green-600">
                            {{ session('status') }}
                            Enviamos seu link de redefinição de senha por e-mail!
                        </div>
                    @endif
                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button>
                            {{ __('Email Password Reset Link') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
</x-guest-layout>

