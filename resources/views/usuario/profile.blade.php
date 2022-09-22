@extends('layouts.app')
    @section('titulo', 'MyRecipes')
    @section('conteudo')
        <main role="main">
            <div class="container pt-3 pb-3">
                <div class="d-flex align-items-start">
                    <div class="container row">
                        @if (Auth::user()->id == $usuario->id)
                            <div class="card col-3 me-3" style="width:13.5rem; max-height: 30rem">
                        @else
                            <div class="card col-3 me-3" style="width:13.5rem; max-height: 22rem">         
                        @endif 
                            <div class="card-body">
                                <div class="nav flex-column nav-pills me-3 mx-auto" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active botaousuario" id="v-pills-perfil-tab" data-bs-toggle="pill" data-bs-target="#v-pills-perfil" type="button" role="tab" aria-controls="v-pills-perfil" aria-selected="true" style="height: 3.6rem; width:10rem ;">Perfil</button>
                                    @if (Auth::user()->id == $usuario->id)
                                        <button class="nav-link mt-2 botaousuario" id="v-pills-receita-tab" data-bs-toggle="pill" data-bs-target="#v-pills-receita" type="button" role="tab" aria-controls="v-pills-receita" aria-selected="false" style="height: 3.6rem; width:10rem ;">Minhas&nbsp;Receitas</button>
                                    @else
                                        <button class="nav-link mt-2 botaousuario" id="v-pills-receita-tab" data-bs-toggle="pill" data-bs-target="#v-pills-receita" type="button" role="tab" aria-controls="v-pills-receita" aria-selected="false" style="height: 3.6rem; width:10rem ;">Receitas</button>
                                    @endif
                                    <button class="nav-link mt-2 botaousuario" id="v-pills-curtida-tab" data-bs-toggle="pill" data-bs-target="#v-pills-curtida" type="button" role="tab" aria-controls="v-pills-curtida" aria-selected="false" style="height: 3.6rem; width:10rem ;">Curtidas</button>
                                    <button class="nav-link mt-2 botaousuario" id="v-pills-favoritas-tab" data-bs-toggle="pill" data-bs-target="#v-pills-favoritas" type="button" role="tab" aria-controls="v-pills-favoritas" aria-selected="false" style="height: 3.6rem; width:10rem ;">Favoritadas</button>
                                    @if (Auth::user()->id == $usuario->id)
                                        <button class="nav-link mt-2 botaousuario" id="v-pills-escondida-tab" data-bs-toggle="pill" data-bs-target="#v-pills-escondida" type="button" role="tab" aria-controls="v-pills-escondida" aria-selected="false" style="height: 3.6rem; width:10rem ;">Escondidas</button>
                                        <button class="nav-link mt-2 botaousuario" id="v-pills-detalhes-tab" data-bs-toggle="pill" data-bs-target="#v-pills-detalhes" type="button" role="tab" aria-controls="v-pills-detalhes" aria-selected="false" style="height: 3.6rem; width:10rem ;">Detalhes&nbsp;Conta</button>
                                    @endif
                                    <a class="nav-link mt-2 text-center botaousuario" type="button" role="tab" aria-selected="false" style="height: 3.6rem; width:10rem ;" href="{{url('amigos/' . $usuario->id)}}">Amigos</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content col-9" id="v-pills-tabContent">
                            <div class="tab-pane fade show active bg-transparent" id="v-pills-perfil" role="tabpanel" aria-labelledby="v-pills-perfil-tab">
                                <div class="row col">
                                    <div class="card fonteTituloReceitas">
                                        <div class="row g-0">
                                            @if (Auth::user()->id == $usuario->id)
                                                <div class="text-end pe-2" style="z-index: 10; top: 0px; left: 0px; position: absolute;">
                                                    <button type="button" class="position-relative bg-transparent border-0" id="notificacao">
                                                        <i class="fa-solid fa-bell"></i>
                                                        @if (count($notificacaos) > 0)
                                                            <h6>
                                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                                    {{$notificacaos->count() > 10 ? '9+' : $notificacaos->count()}}
                                                                </span>
                                                            </h6>
                                                        @endif
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="col-md-4 mb-3 mt-3">
                                                <img src="{{$usuario->foto ? asset('foto_usuario' . '/' . $usuario->foto->anexo) : asset('foto_usuario/baiacu_2.0.jpg')}}" class="img-fluid rounded-start" height="500px">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div class="container mt-3 row">
                                                        <h5 class=" col-12">Nome: {{$usuario->name}}</h5>
                                                    </div>
                                                    @if ($usuario->rank != 'incompleto')
                                                        <div class="container mt-3 row">
                                                            <h5 class=" col-12">Rank: {{$usuario->rank}}</h5>
                                                        </div>
                                                    @endif
                                                    <div class="container mt-3 row">
                                                        <h5 class="col-12">Email: {{$usuario->email}}</h5>
                                                    </div>
                                                    <div class="container mt-3 row">
                                                        <h5 class="col-6">Entrou: {{Carbon\Carbon::parse($usuario->created_at)->format('d-m-Y')}}</h5>
                                                        <h5 class=" col-6 text-end">Idade: {{$usuario->data_nascimento ? Carbon\Carbon::parse($usuario->data_nascimento)->diffInYears(Carbon\Carbon::today()) . ' Anos' : 'Não Informada'}}</h5>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    Seguidores: {{count($usuario->seguidor->where('usuario_id', $usuario->id)) > 0 ? $usuario->seguidor->where('usuario_id', $usuario->id)->count() : 0}}
                                                    @unless (Auth::user()->id == $usuario->id)
                                                        @if(in_array($usuario->id, $array_seguindo))
                                                            <a data-usuario="{{$usuario->id}}" class="deixar_seguir" title="Deixar de Seguir">
                                                                <i class="fa-solid fa-user-check"></i>
                                                            </a>
                                                        @else
                                                            <a data-usuario="{{$usuario->id}}" class="seguir" title="Seguir">
                                                                <i class="fa-solid fa-user-plus"></i>
                                                            </a>
                                                        @endif
                                                    @endunless
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="v-pills-receita" role="tabpanel" aria-labelledby="v-pills-receita-tab">
                                <div class="row col">
                                    @if (count($receitas) == 0)
                                        <div class="card text-center">
                                            <p class="pt-3 pb-1">Este Usuário Não Possui Receitas Cadastradas</p>
                                        </div>
                                    @else
                                        @foreach ($receitas as $item)
                                            <div class="card mb-3">
                                                <div class="row g-0">
                                                    <div class="col-md-4 mb-2 mt-2" style="height: 15rem; width: 15rem;">
                                                        <img src="{{$item->foto ? asset('foto_receitas/' . $item->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem; width: 15rem;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <a class="row" href="{{url('visualizar_receitas/')}}/{{$item->id}}" style="text-decoration: none; color: black">
                                                                <h5 class="card-title col-6 fonteTituloReceitas">{{$item->titulo_receita}}</h5>
                                                                @if ($item->velocidade_id == 1)
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(18, 233, 18)"></i></h6>
                                                                @elseif($item->velocidade_id == 2)
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 233, 18)"></i></h6>
                                                                @else
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 18, 18)"></i></h6>
                                                                @endif
                                                                
                                                                @if (strlen($item->descricao) < 180)
                                                                    <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->descricao, 0, 180)!!}</h5>
                                                                @else
                                                                    <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->descricao, 0, 180) . '...' !!}</h5>
                                                                @endif
                                                            </a>
                                                            <div class="text-end">
                                                                <i class="fa-regular fa-eye"></i> {{count($item->visualizacoes->where('receita_id', $item->id)) > 0 ? $item->visualizacoes->where('receita_id', $item->id)->count() : 0}}&nbsp;&nbsp;&nbsp;
                                                                <i class="fa-solid fa-thumbs-up"></i> {{count($item->curtida->where('receita_id', $item->id)) > 0 ? $item->curtida->where('receita_id', $item->id)->count() : 0}}
                                                            </div>
                                                            @if (Auth::user()->id == $item->user_id)
                                                                <div class="text-end">
                                                                    <a href="{{url('editar_receitas/')}}/{{$item->id}}" class="btn btn-warning text-light text-center" style="height: 36px">
                                                                        <h6>editar receita</h6>
                                                                    </a>
                                                                    <button data-id="{{$item->id}}" class="btn btn-danger deletar_receita text-light text-center">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </div>  
                                                            @endif 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="v-pills-curtida" role="tabpanel" aria-labelledby="v-pills-curtida-tab">
                                <div class="row col">
                                    @if (count($curtidas) == 0)
                                        <div class="card text-center">
                                            <p class="pt-3 pb-1">Este Usuário Não Curtiu Receitas</p>
                                        </div>
                                    @else
                                        @foreach ($curtidas as $item)
                                            <div class="card mb-3">
                                                <div class="row g-0">
                                                    <div class="col-md-4 mb-2 mt-2" style="height: 15rem; width: 15rem;">
                                                        <img src="{{$item->receita->foto ? asset('foto_receitas/' . $item->receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem; width: 15rem;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <a class="row" href="{{url('visualizar_receitas/')}}/{{$item->receita_id}}" style="text-decoration: none; color: black">
                                                                <h5 class="card-title col-6 fonteTituloReceitas">{{$item->receita->titulo_receita}}</h5>
                                                                @if ($item->receita->velocidade_id == 1)
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(18, 233, 18)"></i></h6>
                                                                @elseif($item->receita->velocidade_id == 2)
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 233, 18)"></i></h6>
                                                                @else
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 18, 18)"></i></h6>
                                                                @endif

                                                                @if (strlen($item->receita->descricao) < 180)
                                                                    <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->receita->descricao, 0, 180)!!}</h5>
                                                                @else
                                                                    <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->receita->descricao, 0, 180) . '...' !!}</h5>
                                                                @endif
                                                            </a>
                                                            <div class="text-end">
                                                                <i class="fa-regular fa-eye"></i> {{count($item->receita->visualizacoes->where('receita_id', $item->receita_id)) > 0 ? $item->receita->visualizacoes->where('receita_id', $item->receita_id)->count() : 0}}&nbsp;&nbsp;&nbsp;
                                                                <i class="fa-solid fa-thumbs-up"></i> {{$item->where('receita_id', $item->receita_id)->count() ?? 0}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="v-pills-favoritas" role="tabpanel" aria-labelledby="v-pills-favoritas-tab">
                                <div class="row col">
                                    @if (count($favoritas) == 0)
                                        <div class="card text-center">
                                            <p class="pt-3 pb-1">Este Usuário Não Tem Receitas Favoritas</p>
                                        </div>
                                    @else
                                        @foreach ($favoritas as $item)
                                        <div class="card mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-4 mb-2 mt-2" style="height: 15rem; width: 15rem;">
                                                    <img src="{{$item->receita->foto ? asset('foto_receitas/' . $item->receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem; width: 15rem;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <a class="row" href="{{url('visualizar_receitas/')}}/{{$item->receita_id}}" style="text-decoration: none; color: black">
                                                            <h5 class="card-title col-6 fonteTituloReceitas">{{$item->receita->titulo_receita}}</h5>
                                                            @if ($item->receita->velocidade_id == 1)
                                                                <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(18, 233, 18)"></i></h6>
                                                            @elseif($item->receita->velocidade_id == 2)
                                                                <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 233, 18)"></i></h6>
                                                            @else
                                                                <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 18, 18)"></i></h6>
                                                            @endif

                                                            @if (strlen($item->receita->descricao) < 180)
                                                                <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->receita->descricao, 0, 180) !!}</h5>
                                                            @else
                                                                <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->receita->descricao, 0, 180) . '...' !!}</h5>
                                                            @endif
                                                        </a>
                                                        <div class="text-end">
                                                            <i class="fa-regular fa-eye"></i> {{count($item->receita->visualizacoes->where('receita_id', $item->receita_id)) > 0 ? $item->receita->visualizacoes->where('receita_id', $item->receita_id)->count() : 0}}&nbsp;&nbsp;&nbsp;
                                                            <i class="fa-solid fa-thumbs-up"></i> {{count($item->receita->curtida->where('receita_id', $item->receita_id)) > 0  ? $item->receita->curtida->where('receita_id', $item->receita_id)->count() : 0}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>                            
                            <div class="tab-pane fade show" id="v-pills-escondida" role="tabpanel" aria-labelledby="v-pills-escondida-tab">
                                <div class="row col">
                                    @if (count($escondidas) == 0)
                                        <div class="card text-center">
                                            <p class="pt-3 pb-1">Você Não Tem Receitas Escondidas</p>
                                        </div>
                                    @else
                                        @foreach ($escondidas as $item)
                                            <div class="card mb-3" >
                                                <div class="row g-0">
                                                    <div class="col-md-4 mb-2 mt-2" style="height: 15rem; width: 15rem;">
                                                        <img src="{{$item->foto ? asset('foto_receitas/' . $item->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem; width: 15rem;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <a class="row" href="{{url('visualizar_receita_escondida/')}}/{{$item->id}}" style="text-decoration: none; color: black">
                                                                <h5 class="card-title col-6 fonteTituloReceitas">{{$item->titulo_receita}}</h5>
                                                                @if ($item->velocidade_id == 1)
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(18, 233, 18)"></i></h6>
                                                                @elseif($item->velocidade_id == 2)
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 233, 18)"></i></h6>
                                                                @else
                                                                    <h6 class="card-text col-6 text-end mb-1 fonteVelocidadeReceitas">{{$item->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 18, 18)"></i></h6>
                                                                @endif
                                                                
                                                                @if (strlen($item->descricao) < 180)
                                                                    <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->descricao, 0, 180)!!}</h5>
                                                                @else
                                                                    <h5 class="card-text col-12 fonteDescricaoReceitas">{!! substr($item->descricao, 0, 180) . '...' !!}</h5>
                                                                @endif
                                                            </a>
                                                            <div class="text-end">
                                                                <i class="fa-regular fa-eye"></i> {{count($item->visualizacoes->where('receita_id', $item->id)) > 0 ? $item->visualizacoes->where('receita_id', $item->id)->count() : 0}}
                                                            </div>
                                                            @if (Auth::user()->id == $item->user_id)
                                                                <div class="text-end">
                                                                    <a href="{{url('editar_receitas/')}}/{{$item->id}}" class="btn btn-warning text-light text-center" style="height: 36px">
                                                                        <h6>editar receita</h6>
                                                                    </a>
                                                                    <button data-id="{{$item->id}}" class="btn btn-danger deletar_receita text-light text-center">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </div>  
                                                            @endif 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>                           
                            <div class="tab-pane fade show" id="v-pills-detalhes" role="tabpanel" aria-labelledby="v-pills-detalhes-tab">
                                <div class="row col">
                                    <div class="card ps-4">
                                        {!! Form::open(["id"=>"editForm"]) !!}
                                            @csrf
                                            <div class="card-body mt-3">
                                                <div class="input-group mb-3 row">
                                                    <label class="form-label obrinome faltadados" hidden>
                                                    </label>
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">
                                                        Nome:
                                                    </span>
                                                    <input type="text" value="{{$usuario->name}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nome" id="nome">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <label class="form-label obriemail faltadados" hidden>
                                                    </label>
                                                    <label class="form-label usoemail faltadados" hidden>
                                                        <h6>Este E-Mail já está em uso</h6>
                                                    </label>
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">E-mail:</span>
                                                    <input type="text" value="{{$usuario->email}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email" id="email">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <label class="form-label obrisenha faltadados" hidden>
                                                    </label>
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Senha:</span>
                                                    <input type="password" placeholder="Nào é necessário preencher este campo se quiser manter a mesma senha" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="senha" id="senha">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Telefone:</span>
                                                    <input type="text" value="{{old('telefone') ? old('telefone') : ($usuario->telefone ? $usuario->telefone : '')}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="DDD e 9 adicional" name="telefone" id="telefone">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-3" id="inputGroup-sizing-default">Data Nascimento:</span>
                                                    <input type="date" value="{{old('nascimento') ? old('nascimento') : ($usuario->data_nascimento ? $usuario->data_nascimento : '')}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nascimento" id="nascimento">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Gênero:</span>
                                                    <input type="text" value="{{old('genero') ? old('genero') : ($usuario->genero)}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="genero" id="genero">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Rua:</span>
                                                    <input type="text" value="{{old('rua') ? old('rua') : ($usuario->endereco ? $usuario->endereco->rua : '')}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="rua" id="rua">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Número:</span>
                                                    <input type="text" value="{{old('numero') ? old('numero') : ($usuario->endereco ? $usuario->endereco->numero : '')}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="numero" id="numero">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Bairro:</span>
                                                    <input type="text" value="{{old('bairro') ? old('bairro') : ($usuario->endereco ? $usuario->endereco->bairro : '')}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="bairro" id="bairro">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Cidade:</span>
                                                    <input type="text" value="{{old('cidade') ? old('cidade') : ($usuario->endereco ? $usuario->endereco->cidade : '')}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cidade" id="cidade">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">CEP:</span>
                                                    <input type="text" value="{{old('cep') ? old('cep') : ($usuario->endereco ? $usuario->endereco->cep : '')}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cep" id="cep">
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <label class="form-label obriuf faltadados" hidden>
                                                    </label>
                                                    <label class="input-group-text col-2" for="inputuf">UF:</label>
                                                    <select class="form-select col-9" name="uf" disabled id="uf">
                                                        <option value="{{$usuario->endereco ? $usuario->endereco->uf_id : ''}}">{{$usuario->endereco ? $usuario->endereco->uf->uf : ''}}</option>
                                                        @foreach ($ufs as $item)
                                                            <option value="{{$item->id}}">{{$item->uf}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3 row">
                                                    <label class="form-label obripais faltadados" hidden>
                                                    </label>
                                                    <label class="input-group-text col-2" for="inputpais">País:</label>
                                                    <select class="form-select col-9" name="pais" disabled id="pais">
                                                        <option value="{{$usuario->endereco ? $usuario->endereco->pai_id : ''}}">{{$usuario->endereco ? $usuario->endereco->pais->pais : ''}}</option>
                                                        @foreach ($paises as $item)
                                                            <option value="{{$item->id}}">{{$item->pais}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3 row" id="botao_imagem" hidden>
                                                    <span class="input-group-text col-2" id="inputGroup-sizing-default">Foto:</span>
                                                    <input type="file" class="form-control col-9" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="imagem" id="imagem">
                                                </div>
                                                <div class="container text-center">
                                                    <button class="btn btn-primary col-2 border-0" type="button" id="editar" style="height:50px; background-color: #ff8c00; color:white">Editar</button>
                                                </div>
                                                <div class="container text-center">
                                                    <input class="btn btn-primary col-2 border-0" type="button" value="Salvar" id="salvar" style="height:50px; background-color: #ff8c00; color:white" hidden>
                                                </div>
                                            </div>
                                        {!! Form::close() !!}
                                        <div class="container text-end">
                                            @if (Auth::user()->id == $usuario->id)
                                                <button class="btn btn-danger deletar_user text-light text-center">
                                                    Deletar Conta
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="NoCanto" id="alerta_sucesso_editar" hidden>
            <div class="alert alert-success" role="alert">
                Usuário Editado com Sucesso!
            </div>
        </div>

        <div class="NoCanto" id="alerta_sucesso_seguir" hidden>
            <div class="alert alert-success" role="alert">
                Você começou a segui-lo(a)!
            </div>
        </div>

        <div class="NoCanto" id="alerta_sucesso_deixar_seguir" hidden>
            <div class="alert alert-success" role="alert">
                Você deixou de segui-lo(a)!
            </div>
        </div>

        <div class="NoCanto" id="alerta_sucesso_deletar_receita" hidden>
            <div class="alert alert-success" role="alert">
                Receita deletada com sucesso!
            </div>
        </div>

        <div class="NoCanto" id="alerta_sucesso_deletar_user" hidden>
            <div class="alert alert-success" role="alert">
                Triste em lhe ver partir, Até Breve!
            </div>
        </div>

        <div class="NoCanto" id="alerta_sucesso_ler" hidden>
            <div class="alert alert-success" role="alert">
                Notificação lida com sucesso!
            </div>
        </div>

        <div class="NoCanto" id="alerta_sucesso_ler_todas" hidden>
            <div class="alert alert-success" role="alert">
                Notificações lidas com sucesso!
            </div>
        </div>

        <div class="modal fade" id="avisoModal" data-bs-backdrop="static" role="dialog">
            <div class="modal-dialog bordaBonita">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fonteMaisFamosas">Aviso</h4>
                    </div>
                    <div class="modal-body fonteVelocidadeReceitas">
                        Ao clicar em deletar, sua conta e suas receitas serão todas deletadas!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                        @if (Auth::user()->id == $usuario->id)
                            <button data-id="{{$usuario->id}}" class="btn btn-danger deletar text-light text-center">
                                Deletar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="notificacaoModal" role="dialog">
            <div class="modal-dialog modal-lg bordaBonita">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fonteMaisFamosas">Notificações</h4>
                        @if (count($notificacaos) > 0)
                            <div class="text-end col-2">
                                <div class="form-check text-right form-switch">
                                    <input class="form-check-input" type="checkbox" id="confirmar_tudo">
                                    <label class="form-check-label fonteVelocidadeReceitas" for="confirmar_tudo">Ler todas</label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-body fonteVelocidadeReceitas">
                        @if (count($notificacaos) == 0)
                            <p>Sem notficações</p>
                        @else
                            @foreach ($notificacaos as $n)
                                <div class="row">
                                    <div class="text-start col-9">
                                        {{$n->notificacao}}
                                    </div>
                                    <div class="text-end col-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" data-id="{{$n->id}}" type="checkbox" id="confirmar">
                                            <label class="form-check-label" for="{{$n->id}}">Marcar como lido</label>
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal" style="background-color: #ff8c00;color: white;">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('pos-script')
        <script type="text/javascript">
            $(document).on('click', '#editar', function(){
                $('#editar').prop('hidden', true);
                $('#salvar').prop('hidden', false);
                $('#nome').prop('readonly', false);
                $('#email').prop('readonly', false);
                $('#senha').prop('readonly', false);
                $('#telefone').prop('readonly', false);
                $('#nascimento').prop('readonly', false);
                $('#genero').prop('readonly', false);
                $('#rua').prop('readonly', false);
                $('#numero').prop('readonly', false);
                $('#bairro').prop('readonly', false);
                $('#cidade').prop('readonly', false);
                $('#cep').prop('readonly', false);
                $('#uf').prop('disabled', false);
                $('#pais').prop('disabled', false);
                $('#botao_imagem').prop('hidden', false);
                $('.deletar_user').prop('hidden', true);
            });

            $(document).on('click', '#salvar', function(){
                var formData = new FormData($("#editForm")[0]);
                $.ajax({ // Conex�o ajax e dados a serem enviados
                    type: "POST",
                    url: "{{url('editar_usuario')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if ((data.errors)) {
                            $('#v-pills-detalhes').addClass( "active" );
                            $('#v-pills-detalhes-tab').addClass( "active" ); 

                            $('#v-pills-perfil').removeClass( "active" ); 
                            $('#v-pills-perfil-tab').removeClass( "active" );  
                            
                            $.each(data.errors, function(index, element){
                                $(".obri"+index).prop("hidden", false);
                                $(".obri"+index).text(element);
                            });
                        }
                        else{
                            $('#alerta_sucesso_editar').prop('hidden', false);

                            $('#alerta_sucesso_editar').fadeOut(5000);

                            setTimeout(() => {
                                $('#alerta_sucesso_editar').remove()
                                window.location.reload(true);
                            }, 5050);
                        }
                    }
                });
            });

            $("input[name='telefone']").keyup(function() {
                $(this).val($(this).val().replace(/^(\d{2})(\d{1})(\d{4})(\d{4})$/, "($1) $2 $3-$4"));
            });

            $(document).on('click', '.seguir', function(){
                $.ajax({
                    type: 'POST', 
                    url: "{{ url('seguir') }}", 
                    data: { 
                        id: $(this).data('usuario'),
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('#alerta_sucesso_seguir').prop('hidden', false);

                        $('#alerta_sucesso_seguir').fadeOut(5000);

                        setTimeout(() => {
                            $('#alerta_sucesso_seguir').remove()
                            window.location.reload(true);
                        }, 5050);
                    }
                });
            });

            $(document).on('click', '.deixar_seguir', function(){
                $.ajax({
                    type: 'POST', 
                    url: "{{ url('deixar_seguir') }}", 
                    data: { 
                        id: $(this).data('usuario'),
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('#alerta_sucesso_deixar_seguir').prop('hidden', false);

                        $('#alerta_sucesso_deixar_seguir').fadeOut(5000);

                        setTimeout(() => {
                            $('#alerta_sucesso_deixar_seguir').remove()
                            window.location.reload(true);
                        }, 5050);
                    }
                });
            });
            
            $(document).on('click', '.deletar_receita', function(){
                $.ajax({
                    type: 'POST', 
                    url: "{{url('excluir_receita')}}", 
                    data: { 
                        id: $(this).data('id'),
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('#alerta_sucesso_deletar_receita').prop('hidden', false);

                        $('#alerta_sucesso_deletar_receita').fadeOut(5000);

                        setTimeout(() => {
                            $('#alerta_sucesso_deletar_receita').remove()
                            window.location.reload(true);
                        }, 5050);
                    }
                });
            });

            $(document).on('click', '.deletar_user', function(){
                $("#avisoModal").modal('show');
            });

            $(document).on('click', '.deletar', function(){
                $("#avisoModal").modal('hide');
                $.ajax({
                    type: 'POST', 
                    url: "{{url('excluir_usuario')}}", 
                    data: { 
                        id: $(this).data('id'),
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('#alerta_sucesso_deletar_user').prop('hidden', false);

                        $('#alerta_sucesso_deletar_user').fadeOut(5000);

                        setTimeout(() => {
                            $('#alerta_sucesso_deletar_user').remove()
                            window.location.href = "{{url('/')}}";
                        }, 5050);
                    }
                });
            });

            $(document).on('click', '#notificacao', function(){
                $("#notificacaoModal").modal('show');
            })

            $(document).on('click', '#confirmar', function(){
                $.ajax({
                    type: 'POST', 
                    url: "{{ url('ler_notificacao') }}", 
                    data: { 
                        id: $(this).data('id'),
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('#alerta_sucesso_ler').prop('hidden', false);
                        $('#alerta_sucesso_ler').fadeOut(5000);
                        setTimeout(() => {
                            $('#alerta_sucesso_ler').remove()
                        }, 5050);
                    }
                });
            });

            $(document).on('click', '#confirmar_tudo', function(){
                $.ajax({
                    type: 'POST', 
                    url: "{{ url('ler_todas') }}", 
                    data: { 
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('#alerta_sucesso_ler_todas').prop('hidden', false);
                        $('#alerta_sucesso_ler_todas').fadeOut(5000);
                        setTimeout(() => {
                            $('#alerta_sucesso_ler_todas').remove()
                        }, 5050);
                    }
                });
            })
        </script>
    @endsection
