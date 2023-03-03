<x-guest-layout>
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>GTO</b></a>
                <p>Gestão de Tarefas Online</p>
                <p class="text-warning"><b>ERROR 406</b></p>
            </div>
            <div class="card-body">
                <div class="error-content px-4">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Conta não Vinculada.</h3>
                    <p>
                        Conta não vinculada a uma empresa.<br/>
                        Por favor, entre em contato com o seu administrador do sistema.
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
