@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')

    <main role="main">
        <ul class="nav nav-tabs " id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-light bg-transparent" id="receita-tab" data-bs-toggle="tab" data-bs-target="#receitas" type="button" role="tab" aria-controls="receitas" aria-selected="true">
                    Receitas
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-light bg-transparent" id="profile-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab" aria-controls="usuarios" aria-selected="false">
                    Usuários
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active bg-transparent" id="receitas" role="tabpanel" aria-labelledby="receitas-tab">
                <div class="card-body justify-content-center mx-0 row">
                    @if (count($receitas) == 0)
                        <p>Sem resulatdos para a pesquisa</p>
                    @else
                        @foreach ($receitas as $receita)
                            <div class="card me-3 mb-3" style="width: 18rem;">
                                <img class="pt-2" src="{{$receita->foto ? asset('foto_receitas' . '/' . $receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$receita->titulo_receita}}
                                    </h5>
                                    <a href="{{url('visualizar_receitas')}}/{{$receita->id}}" class="btn btn-primary" style="background-color: #ff8c00; color:white; border: 0px">Vá Para a Receita</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade bg-transparent" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                <div class="card-body justify-content-center mx-0 row">
                    @if (count($usuarios) == 0)
                        <p>Sem resulatdos para a pesquisa</p>
                    @else
                        @foreach ($usuarios as $usuario)
                            <div class="card me-3 mb-3" style="width: 18rem;">
                                <img class="pt-2" src="{{$usuario->foto ? asset('foto_usuario' . '/' . $usuario->foto->anexo) : asset('foto_usuario/baiacu_2.0.jpg')}}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$usuario->name}}
                                    </h5>
                                    <a href="{{url('profile')}}/{{$usuario->id}}" style="background-color: #ff8c00; color:white; border: 0px" class="btn btn-primary">Vá para a página do usuário</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection