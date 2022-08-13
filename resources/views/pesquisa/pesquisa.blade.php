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
                            <div class="card me-3 mb-3 col-5" style="width: 20rem">
                                <img class="pt-2" src="{{$usuario->foto ? asset('foto_usuario' . '/' . $usuario->foto->anexo) : asset('foto_usuario/baiacu_2.0.jpg')}}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$usuario->name}}
                                    </h5>
                                    <div class="row">
                                        <a href="{{url('profile')}}/{{$usuario->id}}" style="background-color: #ff8c00; color:white; border: 0px" class="btn btn-primary col-6">Acessar Página</a>
                                        @unless ($usuario->id == Auth::user()->id)
                                            @if(in_array($usuario->id, $array_seguidores))
                                                <a data-usuario="{{$usuario->id}}" class="segue_ou_nao" title="Deixar de Seguir" data-status="deixar_de_seguir">
                                                    <i class="fa-solid fa-user-check"></i>
                                                </a>
                                            @else
                                                <a data-usuario="{{$usuario->id}}" class="segue_ou_nao" title="Seguir" data-status="seguir">
                                                    <i class="fa-solid fa-user-plus"></i>
                                                </a>
                                            @endif
                                        @endunless
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
        $(document).on('click', '.segue_ou_nao', function(){
            var status = $(this).data('status');
            $.ajax({
                type: 'POST', 
                url: "{{ url('segue_ou_nao') }}", 
                data: { 
                    id: $(this).data('usuario'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    if(status === 'seguir'){
                        $('#alerta_sucesso_seguir').prop('hidden', false);

                        $('#alerta_sucesso_seguir').fadeOut(5000);

                        setTimeout(() => {
                            $('#alerta_sucesso_seguir').remove()
                            window.location.reload(true);
                        }, 5050);
                    }
                    else{
                        $('#alerta_sucesso_deixar_seguir').prop('hidden', false);

                        $('#alerta_sucesso_deixar_seguir').fadeOut(5000);

                        setTimeout(() => {
                            $('#alerta_sucesso_deixar_seguir').remove()
                            window.location.reload(true);
                        }, 5050);
                    }
                }
            });
        });
    </script>
@endsection