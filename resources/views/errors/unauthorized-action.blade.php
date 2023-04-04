<div class="error-page" style="padding-top: 135px; margin: auto">
    <h2 class="headline text-warning"> 403</h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Acesso Negado.</h3>
        <p>
            Você não tem permissão para acessar esta pagina.<br/>
            Enquanto isso, você pode voltar para as <a href="{{url('tarefas?userFilter='.Auth::user()->id)}}"> <b>Suas Tarefas</b></a>
        </p>
    </div>
</div>



