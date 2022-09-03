@extends('layouts.app')

    @section('titulo', 'MyRecipes')
    @section('conteudo')
        <main role="main">
            <div class="container p-2">
                <div class="d-flex  align-items-start">
                    <div class="container row">
                        <div class="card col-3" style="width:13.5rem; height:23rem ">   
                            <div class="card-body">
                                <div class="nav flex-column nav-pills me-3 mx-auto" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active mt-2" id="v-pills-perfil-tab" data-bs-toggle="pill" data-bs-target="#v-pills-perfil" type="button" role="tab" aria-controls="v-pills-perfil" aria-selected="true" style="height: 3.6rem; width:10rem ;">Perfil</button>
                                    <button class="nav-link mt-2" id="v-pills-receita-tab" data-bs-toggle="pill" data-bs-target="#v-pills-receita" type="button" role="tab" aria-controls="v-pills-receita" aria-selected="false" style="height: 3.6rem; width:10rem ;">Minhas&nbsp;Receitas</button>
                                    <button class="nav-link mt-2" id="v-pills-curtida-tab" data-bs-toggle="pill" data-bs-target="#v-pills-curtida" type="button" role="tab" aria-controls="v-pills-curtida" aria-selected="false" style="height: 3.6rem; width:10rem ;">Receitas&nbsp;Curtidas</button>
                                    <button class="nav-link mt-2" id="v-pills-favoritas-tab" data-bs-toggle="pill" data-bs-target="#v-pills-favoritas" type="button" role="tab" aria-controls="v-pills-favoritas" aria-selected="false" style="height: 3.6rem; width:10rem ;">Receitas&nbsp;Favoritas</button>
                                    <button class="nav-link mt-2" id="v-pills-detalhes-tab" data-bs-toggle="pill" data-bs-target="#v-pills-detalhes" type="button" role="tab" aria-controls="v-pills-detalhes" aria-selected="false" style="height: 3.6rem; width:10rem ;">Detalhes&nbsp;Conta</button>
                                    <a href="{{url('amigos/' . $usuario->id)}}">Amigos</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content col-9" id="v-pills-tabContent">
                            <div class="tab-pane fade show active bg-transparent" id="v-pills-perfil" role="tabpanel" aria-labelledby="v-pills-perfil-tab">
                                <div class="card ">
                                    <div class="row g-0 m-4">
                                        <div class="col-md-4 ">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSU6xHSdzHFBr_BfjyYBYkcCf4_o_KnP5QiQ&usqp=CAU" class="img-fluid rounded-start" height="500px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="container mt-3 row">
                                                    <h5 class=" col-6 ">nome</h5>
                                                    <h5 class=" col-6 text-end">idade</h5>
                                                </div>
                                                <div class="container mt-3 row">
                                                    <h5 class="col-6">email</h5>
                                                </div>
                                                <div class="container mt-3 row">
                                                    <h5 class="col-6">Entrou Em</h5>
                                                    <h5 class=" col-6 text-end">idade</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-receita" role="tabpanel" aria-labelledby="v-pills-receita-tab">
                                <div class="row col">
                                    @if (count($usuario->receitas) == 0)
                                        <div class="card text-center ms-3">
                                            <p class="pt-3 pb-1">Este Usuário Não Possui Receitas Cadastradas</p>
                                        </div>
                                    @else
                                        @foreach ($usuario->receitas as $item)
                                            <div class="card m-2 " >
                                                <div class="row g-0">
                                                    <div class="col-md-4 " style="height: 15rem; width: 15rem;">
                                                        <img src="{{$item->foto ? asset('foto_receitas/' . $item->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem; width: 15rem;">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <a class="row" href="{{url('visualizar_receitas/')}}/{{$item->id}}" style="text-decoration: none; color: black">
                                                                <h5 class="card-title col-6">{{$item->titulo_receita}}</h5>
                                                                <h5 class="card-text col-6 text-end mb-1">{{$item->velocidade->velocidade}} <i class="fa-solid fa-clock"></i></h5>
                                                                <h5 class="card-text col-12">{!! substr($item->descricao, 0, 300) . '...' !!}</h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-curtida" role="tabpanel" aria-labelledby="v-pills-curtida-tab">
                                <div class="row col">
                                    @if (count($usuario->curtidas) == 0)
                                        <div class="card text-center ms-3">
                                            <p class="pt-3 pb-1">Este Usuário Não Curtiu Receitas</p>
                                        </div>
                                    @else
                                        @foreach ($usuario->curtidas as $item)
                                        <div class="card m-2 " >
                                            <div class="row g-0">
                                                <div class="col-md-4 " style="height: 15rem; width: 15rem;">
                                                    <img src="{{$item->receita->foto ? asset('foto_receitas/' . $item->receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem; width: 15rem;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <a class="row" href="{{url('visualizar_receitas/')}}/{{$item->receita_id}}" style="text-decoration: none; color: black">
                                                            <h5 class="card-title col-6">{{$item->receita->titulo_receita}}</h5>
                                                            <h5 class="card-text col-6 text-end mb-1">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock"></i></h5>
                                                            <h5 class="card-text col-12">{!! substr($item->receita->descricao, 0, 300) . '...' !!}</h5>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-favoritas" role="tabpanel" aria-labelledby="v-pills-favoritas-tab">
                                <div class="row col">
                                    @if (count($usuario->favoritas) == 0)
                                        <div class="card text-center ms-3">
                                            <p class="pt-3 pb-1">Este Usuário Não Tem Receitas Favoritas</p>
                                        </div>
                                    @else
                                        @foreach ($usuario->favoritas as $item)
                                        <div class="card m-2 " >
                                            <div class="row g-0">
                                                <div class="col-md-4 " style="height: 15rem; width: 15rem;">
                                                    <img src="{{$item->receita->foto ? asset('foto_receitas/' . $item->receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem; width: 15rem;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <a class="row" href="{{url('visualizar_receitas/')}}/{{$item->receita_id}}" style="text-decoration: none; color: black">
                                                            <h5 class="card-title col-6">{{$item->receita->titulo_receita}}</h5>
                                                            <h5 class="card-text col-6 text-end mb-1">{{$item->receita->velocidade->velocidade}} <i class="fa-solid fa-clock"></i></h5>
                                                            <h5 class="card-text col-12">{!! substr($item->receita->descricao, 0, 300) . '...' !!}</h5>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="v-pills-detalhes" role="tabpanel" aria-labelledby="v-pills-detalhes-tab">
                                <div class="card ps-4">
                                    <form method="POST" action="{{ url('editar_usuario') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body mt-3">
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Nome:</span>
                                                <input type="text" value="{{$usuario->name}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nome" id="nome">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">E-mail:</span>
                                                <input type="text" value="{{$usuario->email}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email" id="email">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Senha:</span>
                                                <input type="password" value="********" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="senha" id="senha">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Telefone:</span>
                                                <input type="text" value="{{$usuario->telefone ? $usuario->telefone : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="telefone" id="telefone">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Data Nascimento:</span>
                                                <input type="date" value="{{$usuario->data_nascimento ? $usuario->data_nascimento : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nascimento" id="nascimento">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Gênero:</span>
                                                <input type="text" value="{{$usuario->genero}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="genero" id="genero">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Rua:</span>
                                                <input type="text" value="{{$usuario->endereco ? $usuario->endereco->rua : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="rua" id="rua">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Número:</span>
                                                <input type="text" value="{{$usuario->endereco ? $usuario->endereco->numero : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="numero" id="numero">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Bairro:</span>
                                                <input type="text" value="{{$usuario->endereco ? $usuario->endereco->bairro : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="bairro" id="bairro">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Cidade:</span>
                                                <input type="text" value="{{$usuario->endereco ? $usuario->endereco->cidade : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cidade" id="cidade">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">CEP:</span>
                                                <input type="text" value="{{$usuario->endereco ? $usuario->endereco->cep : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="cep" id="cep">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">UF:</span>
                                                <input type="text" value="{{$usuario->endereco ? $usuario->endereco->uf->uf : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="uf" id="uf">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">País:</span>
                                                <input type="text" value="{{$usuario->endereco ? $usuario->endereco->pais->pais : ''}}" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="pais" id="pais">
                                            </div>
                                            <div class="input-group mb-3 row">
                                                <span class="input-group-text col-2" id="inputGroup-sizing-default">Foto:</span>
                                                <input type="file" class="form-control col-9" readonly aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="imagem" id="imagem">
                                            </div>
                                            <div class="container text-center ">
                                                <button class="btn btn-primary col-2 border-0" type="button" id="editar" style="height:50px; background-color: #ff8c00; color:white">Editar</button>
                                            </div>
                                            <div class="container text-center ">
                                                <input class="btn btn-primary col-2 border-0" type="submit" value="Salvar" id="salvar" style="height:50px; background-color: #ff8c00; color:white" hidden>
                                            </div>
                                        </div>
                                    </form>
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
                $('#uf').prop('readonly', false);
                $('#pais').prop('readonly', false);
                $('#imagem').prop('readonly', false);
            });

            const urlParams = new URLSearchParams(window.location.search);
            const editado = urlParams.get('editado');

            if(editado == 'editado'){
                $('#alerta_sucesso_editar').prop('hidden', false);

                $('#alerta_sucesso_editar').fadeOut(5000);

                setTimeout(() => {
                    $('#alerta_sucesso_editar').remove()
                }, 5050);

            }
        </script>
    @endsection
