<x-guest-layout>
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1"><b>GTO</b></p>
                <p>Gestão de Tarefas Online</p>
                <p class="text-danger"><b>Convite Expirado ou Inválido</b></p>
            </div>
            <div class="card-body">
                <div class="error-content px-4">
                    <p class="text-sm">
                        Convite Expirado ou ja usado.<br/>
                        Solicite novamente um convite para o seu administrador.
                    </p>
                    <br/>
                    <form method="POST" action="{{ route('logout') }}" id="logout">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <x-button-blue>Sair</x-button-blue>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
</x-guest-layout>
