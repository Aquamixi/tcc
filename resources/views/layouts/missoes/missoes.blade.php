<div class="text-center fonteTituloReceitas">
    @if (isset($um->missao))
        <p><s>1ª Visualizar sua primeira receita.</s></p>
    @else
        <p>1ª Visualizar sua primeira receita.</p>
    @endif

    @if (isset($dois->missao))
        <p><s>2ª Seguir um usuário.</s></p>
    @else
        <p>2ª Seguir um usuário.</p>
    @endif

    @if (isset($tres->missao))
        <p><s>3ª Criar sua primeira receita.</s></p>
    @else
        <p>3ª Criar sua primeira receita.</p>
    @endif

    @if (isset($quatro->missao))
        <p><s>4ª Compartilhar sua primeira receita.</s></p>
    @else
        <p>4ª Compartilhar sua primeira receita.</p>
    @endif
    
    @if (isset($cinco->missao))
        <p><s>5ª Finalizar cadastro do seu perfil.</s></p>
    @else
        <p>5ª Finalizar cadastro do seu perfil.</p>
    @endif
</div>