@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main" class="fundobom">
        @if(empty($verificar))
            <div class="container pt-5 ">
                <h1 class="fonteMaisFamosas text-center">
                    Ainda não possuímos receitas cadastradas!
                </h1>
                <h3 class="fonteMaisFamosas text-center">
                    <p>Inscreva-se e cadastre uma!</p>
                </h3>
            </div>
        @else
            <div class="container-fluid pt-3">
                <div class="container">
                    @if (count($receita_hoje) > 0)
                        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($receita_hoje as $item)
                                    @if ($loop->first)
                                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>        
                                    @else
                                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{$loop->index}}" aria-current="true" aria-label="Slide {{$loop->iteration }}"></button>   
                                    @endif                  
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($receita_hoje as $item)
                                    @if ($loop->first)
                                        <div class="carousel-item active">
                                    @else
                                        <div class="carousel-item">
                                    @endif
                                        <img src="{{$item->foto ? asset('foto_receitas' . '/' . $item->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" height="400px" width="300px" class="d-block w-100" >
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5><a href="{{url('visualizar_receitas/')}}/{{$item->id}}" style="text-decoration: none; color: black">{{$item->titulo_receita}}</a></h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Próximo</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="container  border-0 bg-transparent">
                <div class=" justify-content-center col-12 mx-auto row">
                    <label class="form-label fonteMaisFamosas text-center">
                        <h2>Receitas {{isset($_GET['categoria']) ? 'Da Categoria: ' . $_GET['categoria'] : ''}} {{isset($_GET['sabor']) ? 'Sabor: ' . $_GET['sabor'] : ''}}</h2>     
                    </label>                    
                    @foreach ($receitas as $receita)
                        <div class="card m-2 col-5" >
                            <div class="row g-0">
                                <div class="col-sm-4 mb-2 mt-2" style="height: 10rem; width: 10rem;">
                                    <img src="{{$receita->foto ? asset('foto_receitas/' . $receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start " style="height: 10rem; width: 10rem;">
                                </div>
                                <div class="col-sm-7" >
                                    <div class="card-body">
                                        <a class="row" href="{{url('visualizar_receitas/')}}/{{$receita->id}}" style="text-decoration: none; color: black">
                                            <h5 class="card-title col-12">{{$receita->titulo_receita}}</h5>
                                            @if ($receita->velocidade_id == 1)
                                                <h6 class="card-text col-6  mb-1">{{$receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(18, 233, 18)"></i></h6>
                                            @elseif($receita->velocidade_id == 2)
                                                <h6 class="card-text col-6  mb-1">{{$receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 233, 18)"></i></h6>
                                            @else
                                                <h6 class="card-text col-6  mb-1">{{$receita->velocidade->velocidade}} <i class="fa-solid fa-clock" style="color: rgb(233, 18, 18)"></i></h6>
                                            @endif
                                            <h6 class="card-text col-12">{!! substr($receita->descricao, 0, 180) . '...' !!}</h6>
                                        </a>
                                        <p class="text-end">Curtidas: {{$receita->curtida ? $receita->curtida->where('receita_id', $receita->id)->count() : 0}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                    <div class="text-center m-2">
                        {!! $receitas->links() !!}
                    </div>
                </div>
            </div>
        @endif
    </main>

    <div class="modal fade" id="avisoModal" role="dialog">
        <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Aviso</h4>
                </div>
                <div class="modal-body">
                    Faça login em um computador Windows, para maior segurança e nossa confiança.
                </div>
                <div class="modal-footer">
                    <button type="button" id="fechaAviso" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
    
        </div>
    </div>

    <div class="NoCanto" id="alerta_sucesso_cadastrar" hidden>
        <div class="alert alert-success" role="alert">
            Receita Cadastrada com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alerta_sucesso_editar" hidden>
        <div class="alert alert-success" role="alert">
            Receita Editada com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alerta_erro_permissao" hidden>
        <div class="alert alert-danger" role="alert">
            <p>
                Ops!
            </p>
            <p>
                Não é Possível Acessar Esta Rota
            </p>
        </div>
    </div>

@endsection
@section('pos-script')
    <script type="text/javascript">
        var first = {{$first_login ?? 0}};

        const urlParams = new URLSearchParams(window.location.search);
        const confirm = urlParams.get('confirm');

        if(first == 1){
            $(document).ready(function(){
                $("#avisoModal").modal('show');
            });
        }

        $('.modal-footer').on('click', '#fechaAviso', function(){
            $.ajax({
                type: 'POST', 
                url: "{{ url('definir_first_login') }}", 
                data: { 
                    data: '0',
                    "_token": "{{ csrf_token() }}",
                } 
            });
        });

        if(confirm == 'receita_cadastrada'){

            $('#alerta_sucesso_editar').remove();
            $('#alerta_erro_permissao').remove();

            $('#alerta_sucesso_cadastrar').prop('hidden', false);

            $('#alerta_sucesso_cadastrar').fadeOut(5000);

            setTimeout(() => {
                $('#alerta_sucesso_cadastrar').remove()
            }, 5050);

        }
        else if(confirm == 'usuario_invalido'){

            $('#alerta_sucesso_editar').remove();
            $('#alerta_sucesso_cadastrar').remove();

            $('#alerta_erro_permissao').prop('hidden', false);

            $('#alerta_erro_permissao').fadeOut(5000);

            setTimeout(() => {
                $('#alerta_erro_permissao').remove()
            }, 5050);

        }
        else if(confirm == 'receita_editada'){

            $('#alerta_sucesso_cadastrar').remove();
            $('#alerta_erro_permissao').remove();

            $('#alerta_sucesso_editar').prop('hidden', false);

            $('#alerta_sucesso_editar').fadeOut(5000);

            setTimeout(() => {
                $('#alerta_sucesso_editar').remove()
            }, 5050);
        }
    </script>
@endsection