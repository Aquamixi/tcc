@extends('layouts.app')
@section('titulo', 'MyRecipes')
@section('conteudo')
    <main role="main">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                        <div class="container pt-5">
                            <h1 class="fonteMaisFamosas text-center">
                                Não foi possível encontrar receitas para esta pesquisa!
                            </h1>
                            <h3 class="fonteMaisFamosas text-center">
                                <p>Tente uma nova!</p>
                            </h3>
                        </div>
                    @else
                        @foreach ($receitas as $receita)
                            <div class="card me-3 mb-3" style="width: 18rem;">
                                <img class="pt-2" src="{{$receita->foto ? asset('foto_receitas' . '/' . $receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="card-img-top">
                                <div class="card-body">
                                    <div class="row">
                                        <h6 class="fs-5 card-title ps-0 col-6">
                                            <a href="{{url('visualizar_receitas')}}/{{$receita->id}}" style="text-decoration: none; color: black">{{substr($receita->titulo_receita, 0, 8) . '...'}}</a>
                                        </h6>
                                        @if ($receita->velocidade_id == 1)
                                            <h6 class="card-text col-6 mb-1 text-end"> {{$receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(18, 233, 18)"></i></h6>
                                        @elseif($receita->velocidade_id == 2)
                                            <h6 class="card-text col-6 mb-1 text-end"> {{$receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 233, 18)"></i></h6>
                                        @else
                                            <h6 class="card-text col-6 mb-1 text-end"> {{$receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 18, 18)"></i></h6>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <h6 class="card-text ps-0 col-12">{!! substr($receita->descricao, 0, 50) . '...' !!}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade bg-transparent" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                <div class="card-body justify-content-center mx-0 row">
                    @if (count($usuarios) == 0)
                        <div class="container pt-5">
                            <h1 class="fonteMaisFamosas text-center">
                                Não foi possível encontrar usuários para esta pesquisa!
                            </h1>
                            <h3 class="fonteMaisFamosas text-center">
                                <p>Tente uma nova!</p>
                            </h3>
                        </div>
                    @else
                        @foreach ($usuarios as $usuario)
                            <div class="card me-3 mb-3" style="width: 18rem;">
                                <img class="pt-2" src="{{$usuario->foto ? asset('foto_usuario' . '/' . $usuario->foto->anexo) : asset('foto_usuario/baiacu_2.0.jpg')}}" class="card-img-top">
                                <div class="card-body">
                                    <div class="row">
                                        <h6 class="fs-5 card-title ps-0 col-10">
                                            <a href="{{url('profile')}}/{{$usuario->id}}" style="text-decoration: none; color: black">{{substr($usuario->name, 0, 8) . '...'}}</a>
                                        </h6>
                                        <div class="col-2 text-right">
                                            @unless ($usuario->id == Auth::user()->id)
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
                                        Rank: {{$usuario->rank}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>

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
@endsection

@section('pos-script')
    <script type="text/javascript">
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
    </script>
@endsection