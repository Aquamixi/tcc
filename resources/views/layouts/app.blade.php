<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            @yield('titulo')
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.5">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css?ver=4.9')}}">
        <link rel="icon" href="{{asset('imagens/loguinho.png')}}">

        <script src="https://kit.fontawesome.com/873886f170.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        @yield('extra_css')
    </head>
    <style>
        main {
    min-height: 100%;
    background-image: linear-gradient(0deg, #FFF323, #ffa700, #ff7400, #ff6600);
    background-size: cover;
}
html, body {
    height: 100%;
    width: 100%;
    -webkit-print-color-adjust: exact;
}


@font-face {
    font-family: Muthiara;
    src: url(font/Muthiara\ demo\ version.otf);
}
@font-face {
    font-family: PoetsenOne;
    src: url(font/PoetsenOne-Regular.ttf);
}
.fonteMyrecipes {
    font-family: Muthiara;
    text-decoration: none;
    color: #fff;
    text-shadow: 3px 0 0 #ff6600, -3px 0 0 #ff6600, 0 3px 0 #ff6600, 0 -3px 0 #ff6600, 1.5px 1.5px #ff6600, -1.5px -1.5px 0 #ff6600, 1.5px -1.5px 0 #ff6600, -1.5px 1.5px 0 #ff6600;
}
.fonteMyrecipes:hover {
    -webkit-transition: all 0.5s ease-out;
    color: #fce620;
}

.fonteMaisFamosas{
    font-family: PoetsenOne;
    color: #fff;
    text-align: left;
    text-shadow: 2px 0 0 #ff9000, -2px 0 0 #ff9000, 0 2px 0 #ff9000, 0 -2px 0 #ff9000, 1px 1px #ff9000, -1px -1px 0 #ff9000, 1px -1px 0 #ff9000, -1px 1px 0 #ff9000;
}

.faltadados{
    font-family: PoetsenOne;
    color: #fff;
    text-align: left;
    text-shadow: 2px 0 0 #cc1414, -2px 0 0 #cc1414, 0 2px 0 #cc1414, 0 -2px 0 #cc1414, 1px 1px #cc1414, -1px -1px 0 #cc1414, 1px -1px 0 #cc1414, -1px 1px 0 #cc1414;
}

.fonteCriarReceitas{
    font-family: PoetsenOne;
    /* opacity: 0.5; */
}
.wrapper {
    display: flex;
    flex-direction: column;
    max-height: 50%;
}

.content {
    flex-grow: 1;
}

.NoCanto{
    position: fixed;
    top: 0px;
    right: 0px;
    width: 30%;
    height: 30%;
    float: right;
    z-index: 999;
}

.checked{
    color: #ffc400;
}

.checkedfor{
    color: #ffc400;
}

.ajusta_imagem{
    object-fit: fill;
}

.botaostar{
    border: 0;
    background: #fff;
}

.botaostar:hover{
    color: #ffc400;
}

.botaoshare{
    border: 0;
    background: #fff;
    text-decoration: none;
    color: #000;
}

.botaoshare:hover{
    color: #ff9000;
    cursor: pointer;
}

.botaofavoritar{
    border: 0;
    background: #fff;
    text-decoration: none;
    color: #000;
}

.botaofavoritar:hover{
    color: red;
    cursor: pointer;
}

.botaocurtir{
    border: 0;
    background: #fff;
    text-decoration: none;
    color: #000;
}

.botaocurtir:hover{
    color: rgb(0, 98, 255);
    cursor: pointer;
}

.favoritado{
    color: red;
    cursor: pointer;
}

.favoritado:hover{
    color:#000;
}

.curtido{
    color: rgb(0, 98, 255);
    cursor: pointer;
}

.curtido:hover{
    color:#000;
}

.comentar{
    color:rgb(0, 0, 0);
}

.comentar:hover{
    color:rgb(24, 194, 69);
}

.botaousuario{
    color: #000;
    font-family: PoetsenOne;
    padding: 0.5rem ;
}
.enviaComentario{
    color: rgb(0, 98, 255);
}

.fonteMissoes{
    color:#000;
    font-size: larger;
}

.fonteTituloReceitas{
    font-size: 1.5rem;
    font-family: PoetsenOne;
}

.fonteVelocidadeReceitas{
    font-size: 1rem;
    font-family: PoetsenOne;
    color: rgba(0, 0, 0, 0.897);
}

.fonteDescricaoReceitas{
    font-size: 0.8rem;
    font-family: PoetsenOne;
    color: rgba(0, 0, 0, 0.73);
}

#picture__input {
    display: none;
}

.picture {
    width: 400px;
    aspect-ratio: 16/9;
    background: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #aaa;
    border: 2px dashed currentcolor;
    cursor: pointer;
    font-family: sans-serif;
    transition: color 300ms ease-in-out, background 300ms ease-in-out;
    outline: none;
    overflow: hidden;
}

.picture:hover {
    color: #777;
    background: #ccc;
}

.picture:active {
    border-color: turquoise;
    color: turquoise;
    background: #eee;
}

.picture:focus {
    color: #777;
    background: #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.picture__img {
    max-width: 100%;
}

.respostas{
    color:#000;
    text-decoration: none;
}

.bordaBonita{
    background: linear-gradient(to right, #FFF323, #FFF323);
    padding: 3px;
    border-radius: 0.5rem;
}
    </style>
    <body>
        <header class="p-1">
            <nav class="navbar navbar-expand navbar-light bg-white">
                <div class="container-fluid">
                    <div class="col-md-2">
                        <a class="fonteMyrecipes" href="{{url('/')}}">
                            <h2>My Recipes</h2>
                        </a>
                    </div>
                    <div class="collapse ms-0 navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-0 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sabor
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($sabores as $item)
                                        <li><a class="dropdown-item" href="{{url('/')}}?sabor={{$item->sabor}}">{{$item->sabor}}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="nav-item dropdown ms-4">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Categoria
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($categorias as $item)
                                        <li><a class="dropdown-item" href="{{url('/')}}?categoria={{$item->categoria}}">{{$item->categoria}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @auth
                                <a class="nav-link ms-4 toggle" href="{{url('/home')}}?seguindo=quem_sigo" role="button" aria-expanded="false">
                                    Quem Sigo
                                </a>
                            @endauth
                        </ul>
                    </div>

                    @if (Auth::check() and Auth::user()->rank == 'incompleto')
                        <button id="missoes" class="btn btn-md btn-primary position-relative">
                            Missões
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle">
                                <span class="visually-hidden"></span>
                            </span>
                        </button>
                    @endif

                    <a href="{{url('criar_receitas')}}" class="btn btn-warning text-light ms-4 me-4" style="height: 36px">
                        <h6>Criar Receita</h6>
                    </a>

                    {!! Form::open(
                        [
                            'url' => url('home') . "?search", 'method' => 'GET', 'class' => 'me-5 mt-0 end-3 col-3', 
                            'autocomplete' => "off"
                        ]
                    ) !!}
                        {!! Form::text(
                            'search',
                            null, 
                            [
                                'class' => 'form-control 01', 
                                'id' => 'popover', 
                                'aria-label' => 'Pesquisa', 
                                'placeholder' => 'Pesquisar', 
                                'data-bs-container' => "body", 
                                'data-bs-toggle' => "popover", 
                                'title' => "Dica:", 
                                'data-bs-placement' => "bottom", 
                                'data-bs-content' => "Pesquise por títulos, nacionalidades, velocidades, categorias, sabores ou ingredientes separados por vírgulas ou até mesmo usuários"
                            ]
                        ) !!}
                    {!! Form::close() !!}

                    @auth
                        <div class="dropdown end-1 text-end">
                            <a href="#" class="d-block link-dark text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="rounded-circle card-img-top" src="{{auth()->user()->foto ? asset('foto_usuario' . '/' . auth()->user()->foto->anexo) : asset('foto_usuario/baiacu_2.0.jpg')}}" width="32" height="32">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="{{url('profile')}}/{{Auth::user()->id}}">Meu Perfil</a></li>
                                <li><a class="dropdown-item" href="{{url('amigos')}}/{{Auth::user()->id}}">Amigos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    @endauth

                    @guest
                        <a href="{{url('login')}}" class="btn btn-outline-warning">Entrar</a>
                    @endguest
                </div>
            </nav>
        </header>

        @yield('conteudo')
        
        <div style="flex-grow:1"></div>
        <footer class="py-3 my-3 wrapper">
            <div class="container-fluid row">
                <div class="col">
                    <a href="/" class="d-flex align-items-center mb-0 link-dark text-decoration-none">
                    </a>
                    <p class="text-muted">© 2022</p>
                </div>
            
                <div class="col">
                    <h5>Contato:</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="https://pt-br.facebook.com/" target="_blank" class="nav-link p-0 text-muted">Facebook</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="https://www.instagram.com/" target="_blank" class="nav-link p-0 text-muted">Instagram</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="https://web.whatsapp.com/send?phone=5545998038841" target="_blank" class="nav-link p-0 text-muted">Whatsapp: (45) 99484-8114</a>
                        </li>
                    </ul>
                </div>
                
                <div class="col">
                    <h5>Quem Somos:</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="#" id="historia" class="nav-link p-0 text-muted">Nossa História</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog bordaBonita">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fonteMaisFamosas">Sobre Nós</h4>
                </div>
                <div class="modal-body fonteVelocidadeReceitas">
                    <p>Silvio Santos Ipsum Vem pra lá, mah você vai pra cá. Agora vai, agora vem pra láamm. Ma você, topa ou não topamm. 
                    Ma você está certo dissoam? Ma não existem mulher feiam, existem mulher que não conhece os produtos Jequitiamm.
                    Ha hai. Bem boladoam, bem boladoam. Bem gozadoam. Wellintaaammmmmmmmm. Boca sujuam... sem vergonhuamm.</p>
                    
                    <p>Qual é a musicamm? Mah ooooee vem pra cá. Vem pra cá. É bom ou não éam? Patríciaaammmm... Luiz Ricardouaaammmmmm. 
                    Vem pra lá, mah você vai pra cá. Agora vai, agora vem pra láamm. É por sua conta e riscoamm?</p>
                    
                    <p>Ma não existem mulher feiam, existem mulher que não conhece os produtos Jequitiamm. 
                    O prêmio é em barras de ouro, que vale mais que dinheiroam. O arriscam tuduam, valendo um milhão de reaisuam. 
                    Você veio da caravana de ondeammm? Ma vejam só, vejam só. O Raul Gil é gayam! ... Maa O Ah Ae! Ih Ih! O Raul Gil é gayamm!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="fecha" class="btn btn-default" data-bs-dismiss="modal" style="background-color: #ff8c00;color: white;">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="missoesModal" role="dialog">
        <div class="modal-dialog bordaBonita">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fonteMaisFamosas" style="font-size: xx-large">Missões</h4>
                </div>
                <div class="modal-body corpo_missoes">
                </div>
                <div class="modal-footer">
                    <button type="button" id="fecha" class="btn btn-default" data-bs-dismiss="modal" style="background-color: #ff8c00;color: white;">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '#historia', function(){
            $("#myModal").modal('show');
        });

        var popover = new bootstrap.Popover(document.querySelector('#popover'), {
            container: 'body'
        });

        $(document).on('click', '#missoes', function(){
            $("#missoesModal").modal('show');
            $.ajax({
                type: 'GET', 
                url: "{{ url('visualizar_missoes') }}", 
                success: function(data){
                    $('.corpo_missoes').html(data);
                }
            });
        });

    </script>
    @yield('pos-script')
</html>