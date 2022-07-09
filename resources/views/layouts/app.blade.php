<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('titulo')</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/873886f170.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('css/style.css?ver=3')}}">
        @yield('extra_css')
    </head>

    <body>
        <header class="p-0 mb-3">
            <nav class="navbar navbar-expand navbar-light bg-white">
                <div class="container-fluid">
                    <div class="ms-0 col-md-2">
                        <a class="fonteMyrecipes" href="{{url('home')}}">
                            <h2>My Recipes</h2>
                        </a>
                    </div>
                    @auth
                        <div class="collapse ms-0 navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav  ms-0 mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sabor
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($sabores as $item)
                                            <li><a class="dropdown-item" href="home?sabor={{$item->sabor}}">{{$item->sabor}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="nav-item dropdown ms-4">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Categoria
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($categorias as $item)
                                            <li><a class="dropdown-item" href="home?categoria={{$item->categoria}}">{{$item->categoria}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        
                        </div>
                        <a href="criar_receitas" class="btn btn-warning mb-2 text-light me-4">
                            <i class="fa-solid fa-receipt"></i>
                        </a>
                        {!! Form::open(['url' => '/home?search', 'method' => 'GET', 'class' => 'me-5 mt-0 end-3 mb-2']) !!}
                            {!! Form::text('search', null, ['class' => 'form-control 01', 'aria-label' => 'Pesquisa', 'placeholder' => 'Pesquisar']) !!}
                        {!! Form::close() !!}
                        <div class="dropdown end-1 text-end">
                            <a href="#" class="d-block link-dark text-decoration-none " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
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