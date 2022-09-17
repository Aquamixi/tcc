<link rel="stylesheet" href="{{asset('css/style.css?ver=4.2')}}">
<div class="text-center">
    @if (isset($um->missao))
        <p class="fonteMissoes"><s>1ª Visualizar sua primeira receita.</s></p>
    @else
        <p class="fonteMissoes">1ª Visualizar sua primeira receita.</p>
    @endif

    @if (isset($dois->missao))
        <p class="fonteMissoes"><s>2ª Seguir um usuário.</s></p>
    @else
        <p class="fonteMissoes">2ª Seguir um usuário.</p>
    @endif

    @if (isset($tres->missao))
        <p class="fonteMissoes"><s>3ª Criar sua primeira receita.</s></p>
    @else
        <p class="fonteMissoes">3ª Criar sua primeira receita.</p>
    @endif

    @if (isset($quatro->missao))
        <p class="fonteMissoes"><s>4ª Compartilhar sua primeira receita.</s></p>
    @else
        <p class="fonteMissoes">4ª Compartilhar sua primeira receita.</p>
    @endif
    
    @if (isset($cinco->missao))
        <p class="fonteMissoes"><s>5ª Finalizar cadastro do seu perfil.</s></p>
    @else
        <p class="fonteMissoes">5ª Finalizar cadastro do seu perfil.</p>
    @endif
</div>