<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('titulo')</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/873886f170.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('css/style.css?ver=4.1')}}">
        @yield('extra_css')
    </head>

    <body>
        <header class="p-1">
            <nav class="navbar navbar-expand navbar-light bg-white">
                <div class="container-fluid">
                    <div class="col-md-2">
                        <a class="fonteMyrecipes" href="{{url('home')}}">
                            <h2>My Recipes</h2>
                        </a>
                    </div>
                    @auth
                        <div class="collapse ms-0 navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav  ms-0 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sabor
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($sabores as $item)
                                            <li><a class="dropdown-item" href="{{'home'}}?sabor={{$item->sabor}}">{{$item->sabor}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="nav-item dropdown ms-4">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Categoria
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($categorias as $item)
                                            <li><a class="dropdown-item" href="{{'home'}}?categoria={{$item->categoria}}">{{$item->categoria}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <a href="{{url('criar_receitas')}}" class="btn btn-warning text-light me-4">
                            <i class="fa-solid fa-receipt"></i>
                        </a>

                        {!! Form::open(['url' => '/home?search', 'method' => 'GET', 'class' => 'me-5 mt-0 end-3']) !!}
                            {!! Form::text('search', null, ['class' => 'form-control 01', 'aria-label' => 'Pesquisa', 'placeholder' => 'Pesquisar']) !!}
                        {!! Form::close() !!}

                        <div class="dropdown end-1 text-end">
                            <a href="#" class="d-block link-dark text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="data:image/jpeg;base64,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" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="#">Seu Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Amigos</a></li>
                                <li><a class="dropdown-item" href="#">Configuraçâo</a></li>
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
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Facebook</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Instagram</a></li>
                        <li class="nav-item mb-2"><a href="https://web.whatsapp.com/send?phone=5545998038841" target="_blank" class="nav-link p-0 text-muted">Whatsapp: (45) 99484-8114</a></li>
                    </ul>
                </div>
                
                <div class="col">
                    <h5>Quem Somos:</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" id="historia" class="nav-link p-0 text-muted">Nossa História</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sobre Nós</h4>
                </div>
                <div class="modal-body">
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
                    <button type="button" id="fecha" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
    
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).on('click', '#historia', function(){
            $("#myModal").modal('show');
        });
    </script>
    @yield('pos-script')
</html>