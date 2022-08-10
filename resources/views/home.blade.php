@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main" class="fundobom">
        <div class="container-fluid pt-3">
            <div class="container">
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
                                    <h5><a href="{{url('visualizar_receitas/')}}/{{$item->id}}">{{$item->titulo_receita}}</a></h5>
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
            </div>
        </div>
        
        <div class="container-fluid card border-0 bg-transparent">
            <div class="card-body justify-content-center col-12 mx-auto row">
                @foreach ($receitas as $receita)
                    <div class="card m-2 col-5" >
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="{{$receita->foto ? asset('foto_receitas/' . $receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style="height: 15rem;">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <a href="{{url('visualizar_receitas/')}}/{{$receita->id}}">
                                        <h5 class="card-title">{{$receita->sabor->sabor}}</h5>
                                        <p class="card-text">{{$receita->titulo_receita}}</p>
                                        <p class="card-text">{{$receita->categoria->sub_categoria->sub_categoria}}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
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
                Parece que Essa Receita Não é Sua.
            </p>
        </div>
    </div>

@endsection
@section('pos-script')
    <script type="text/javascript">
        var first = {{$first_login}};

        const urlParams = new URLSearchParams(window.location.search);
        const confirm = urlParams.get('confirm');

        if(first == 1){
            $(document).ready(function(){
                $("#avisoModal").modal('show');
            });
        }

        $('.modal-footer').on('click', '#fechaAviso', function(){
            $.ajax({
                type: 'POST',  // http method
                url: "{{ url('definir_first_login') }}", // url de destino
                data: { 
                    data: '0',
                    "_token": "{{ csrf_token() }}",
                } // data to submit
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