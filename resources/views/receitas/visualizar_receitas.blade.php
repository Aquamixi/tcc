@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main">
        <div class="container">
            <div class="container p-3">
                <div class="fonteMaisFamosas text-center"> 
                    <h2>{{$receita->titulo_receita}}</h2>                       
                </div>
            </div>
            <div class="container row">
                <div class="card col-12">
                    <div class="row m-1 mb-2 fonteTituloReceitas">
                        <div class="text-center">
                            <a href="{{url('profile') . '/' . $receita->user_id}}" style="text-decoration: none; color:black">
                                <h4>Criador: {{$receita->usuario->name}}</h4>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <img src="{{$receita->foto ? asset('foto_receitas/' . $receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start" style=" width: 400px; height: 230px;">
                        </div>
                        <div class="col-md-8 ms-0">
                            <div class="card-body">
                                <div class="container mt-3 row">
                                    <h5 class="col-6">Velocidade: {{$receita->velocidade->velocidade}}</h5>
                                    <h5 class="col-6 text-end">Quantidade Porções: {{$receita->qtde_porcoes}}</h5>
                                </div>
                                <div class="container mt-3 row">
                                    <h5 class="col-6">Região: {{$receita->nacionalidade->nacionalidade}}</h5>
                                    <h5 class="col-6 text-end">Sabor: {{$receita->sabor->sabor}}</h5>
                                </div>
                                <div class="container mt-3 row">
                                    <div class="col-6">
                                        <h5 class="mb-1">Avaliação: {{number_format((float)$receita->avaliacao, 1, '.', '')}} ({{$receita->avaliacaos->count()}})</h5>
                                        <h3>
                                            @for ($i = 1; $i < 6; $i++)
                                                @if (round($receita->avaliacao) >= $i)
                                                    <button type="radio" data-id="{{$receita->id}}" class="fa fa-star checked botaostar" id="{{$i}}"></button>
                                                @else
                                                    <button type="radio" data-id="{{$receita->id}}" class="fa fa-star botaostar" id="{{$i}}"></button>
                                                @endif
                                            @endfor
                                        </h3>
                                    </div>
                                    <h5 class="col-6 text-end">Categoria: {{$receita->categoria->categoria}}</h5>
                                </div>
                            </div>
                            <div class="text-end">
                                <a title="comentar" href="#" class="comentar" id="comentar"><i class="fa-solid fa-comment"></i></a>
                                @if ($receita->escondida == 0)
                                    @if (count($receita->curtida_user) > 0)
                                        <a title="Descurtir" class="curtido" id="descurtir" data-id="{{$receita->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                    @else
                                        <a title="Curtir" class="botaocurtir" id="curtir" data-id="{{$receita->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                    @endif
                                    @if (count($receita->favoritada_user) > 0)
                                        <a title="Desfavoritar" class="favoritado" id="desfavoritar" data-id="{{$receita->id}}"><i class="fa-solid fa-heart"></i></a>
                                    @else
                                        <a title="Favoritar" class="botaofavoritar" id="favoritar" data-id="{{$receita->id}}"><i class="fa-solid fa-heart"></i></a>
                                    @endif
                                    <a title="Compartilhar" class="botaoshare" id="share"><i class="fa-solid fa-share"></i></a>
                                @endif
                                @if (Auth::user()->id == $receita->user_id and $receita->escondida == 1)
                                    <a title="Compartilhar" class="botaoshare" id="share_escondida" data-id="{{$receita->id}}"><i class="fa-solid fa-share"></i></a>
                                @endif
                                <h6>Data Postagem: {{Carbon\Carbon::parse($receita->data_postagem)->format('d-m-Y')}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="fonteMaisFamosas mt-3">Descrição</h5>
                </div>
                <div class="card col-12">
                    <div class="card-body" style="height:170px;">
                        {!! $receita->descricao !!}
                    </div>
                </div>
                    <div class="">
                        <h5 class="fonteMaisFamosas mt-3">Ingredientes</h5>
                    </div>
                    <div class="card  col-12">
                        <div class="card-body " style="height:170px;">
                            @foreach ($receita->ingrediente as $item)
                                @if ($loop->last)
                                    {{$item->ingrediente}}
                                @else
                                    {{$item->ingrediente}},
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="">
                        <h5 class="fonteMaisFamosas mt-3">Modo De Preparo</h5>
                    </div>
                    <div class="card col-12 mb-3" >
                        <div class="card-body" style="height:170px;">
                            {!! $receita->modo_preparo !!}
                        </div>
                    </div>
                    <div class="">
                        <h5 class="fonteMaisFamosas mt-3">Comentarios</h5>
                    </div>
                    <div class="card col-12 mb-3">
                        <div class="card-header row">
                            <h5 class="col-6">nome:aaaaaaaa</h5>                          
                            <h6 class="col-5 text-end ">10/01/14</h6>                           
                            <h5 class="col-1 text-end ">
                                <div class=" dropend">
                                    <button type="button" class="  border-0 bg-transparent dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" >
                                        <li ><button class="btn bg-transparent" type="submit"><i class="fa-solid fa-trash"></i> Excluir</button></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><button class="btn bg-transparent" type="submit"><i class="fa-solid fa-pen"></i>Editar</button></li>
                                    </ul>
                                </div>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h5>comentario aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</h5>
                        </div>
                        <div class="card-footer row">
                            <h5 class="col-10">
                                <button class="btn btn-link respostas" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Respostas:15
                                </button>
                            </h5>
                            <h5 class="col-1 text-end mt-2">
                                @if (count($receita->curtida_user) > 0)
                                    <a title="Descurtir" class="curtido" id="descurtir" data-id="{{$receita->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                @else
                                    <a title="Curtir" class="botaocurtir" id="curtir" data-id="{{$receita->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                @endif
                            </h5>
                            <h5 class="col-1 text-end mt-2">
                                <a title="Responder" class="comentar" id="responder"><i class="fa-solid fa-comments"></i></a>
                            </h5>
                            <div class="collapse" id="collapseExample">
                                <div class="card">                                    
                                    <div class="row card-header mx-0">
                                        <h6 class="col-11 ">nome aaaa</h6>
                                        <h6 class="col-1 text-end">
                                            @if (count($receita->curtida_user) > 0)
                                            <a title="Descurtir" class="curtido" id="descurtir" data-id="{{$receita->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                            @else
                                            <a title="Curtir" class="botaocurtir" id="curtir" data-id="{{$receita->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                            @endif
                                        </h6>                                        
                                    </div>   
                                    <div class="card-body">
                                        aaaaaaaaaaaaaaaaaaaaaaaaaaaa    
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
            </div>         
        </div>
    </main>

    <div class="modal fade" id="modalComentario" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fonteMaisFamosas">Comentar</h3>
                </div>
                <form action="{{url('comentar_receita')}}" method="post">
                    @csrf
                    <input value="{{$receita->id}}" name="id" hidden>
                    <div class="modal-body">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Escreva aqui o seu comentario" name="comentario" style="resize: none; height:115.7px;">{{old('comentario') ? old('comentario') : ''}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="fecha" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                        <input id="enviaComentario" class="btn btn-primary col-2 border-0" type="submit" value="Enviar" data-bs-dismiss="modal" style="height:40px; background-color: #ff8c00; color:white"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalResponder" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fonteMaisFamosas">Responder</h3>
                </div>
                <form action="{{url('comentar_receita')}}" method="post">
                    @csrf
                    <input value="{{$receita->id}}" name="id" hidden>
                    <div class="modal-body">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Escreva aqui a sua resposta" name="resposta" style="resize: none; height:115.7px;">{{old('resposta') ? old('resposta') : ''}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="fecha" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                        <input id="enviaResposta" class="btn btn-primary col-2 border-0" type="submit" value="Enviar" data-bs-dismiss="modal" style="height:40px; background-color: #ff8c00; color:white"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoCopia" hidden>
        <div class="alert alert-success" role="alert">
            Link copiado com sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoCurtir" hidden>
        <div class="alert alert-success" role="alert">
            Receita Curtida Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoFavoritar" hidden>
        <div class="alert alert-success" role="alert">
            Receita Favoritada Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoDesCurtir" hidden>
        <div class="alert alert-success" role="alert">
            Receita Descurtida Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoDesFavoritar" hidden>
        <div class="alert alert-success" role="alert">
            Receita Desfavoritada Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoAvaliar" hidden>
        <div class="alert alert-success" role="alert">
            Receita Avaliada Com Sucesso!
        </div>
    </div>
@endsection

@section('pos-script')
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script type="text/javascript">
        let urlAtual = window.location.href;

        $(document).on('click', '#share', function(){
            $('#share').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('compartilhar_receita') }}", 
                data: { 
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoCopia').prop('hidden', false);
                    $('#alertaSucessoCopia').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoCopia').remove()
                    }, 5050);
                    return navigator.clipboard.writeText(urlAtual);
                }
            });
        });

        $(document).on('click', '#curtir', function(){
            $('#curtir').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('curtir_receita') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoCurtir').prop('hidden', false);
                    $('#alertaSucessoCurtir').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoCurtir').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#favoritar', function(){
            $('#favoritar').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('favoritar_receita') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoFavoritar').prop('hidden', false);
                    $('#alertaSucessoFavoritar').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoFavoritar').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#descurtir', function(){
            $('#descurtir').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('descurtir_receita') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoDesCurtir').prop('hidden', false);
                    $('#alertaSucessoDesCurtir').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoDesCurtir').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#desfavoritar', function(){
            $('#desfavoritar').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('desfavoritar_receita') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoDesFavoritar').prop('hidden', false);
                    $('#alertaSucessoDesFavoritar').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoDesFavoritar').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });
        
        $(document).on('click', '#comentar', function(){
            $("#modalComentario").modal('show');
        });

        $(document).on('click', '#responder', function(){
            $("#modalResponder").modal('show');
        });
        
        $(document).on('click', '#share_escondida', function(){
            $('#share_escondida').prop('disabled', true);
            var random_token = Math.random().toString(16).substr(2);
            $.ajax({
                type: 'POST', 
                url: "{{ url('compartilhar_receita_escondida') }}", 
                data: { 
                    id: $(this).data('id'),
                    token: random_token,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoCopia').prop('hidden', false);
                    $('#alertaSucessoCopia').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoCopia').remove()
                    }, 5050);
                    return navigator.clipboard.writeText(`${urlAtual}/${random_token}`);
                }
            });
        });

        let ids = [1, 2, 3, 4, 5, 6];

        $(ids).each(function(id){
            $(document).on('click', `#${id}`, function(){
            $(`#${id}`).prop('disabled', true);
                $.ajax({
                    type: 'POST', 
                    url: "{{ url('avaliar_receita') }}", 
                    data: { 
                        id: $(this).data('id'),
                        value: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('#alertaSucessoAvaliar').prop('hidden', false);
                        $('#alertaSucessoAvaliar').fadeOut(5000);
                        setTimeout(() => {
                            $('#alertaSucessoAvaliar').remove()
                            window.location.reload(true);
                        }, 5050);
                    }
                });
            });
        });

        $(document).on('mouseover', '#5', function(){
            $('#5').addClass( "checkedfor" );
            $('#4').addClass( "checkedfor" );
            $('#3').addClass( "checkedfor" );
            $('#2').addClass( "checkedfor" );
            $('#1').addClass( "checkedfor" );
        });
            
        $(document).on('mouseover', '#4', function(){
            $('#4').addClass( "checkedfor" );
            $('#3').addClass( "checkedfor" );
            $('#2').addClass( "checkedfor" );
            $('#1').addClass( "checkedfor" );   
        });                 
            
        $(document).on('mouseover', '#3', function(){
            $('#3').addClass( "checkedfor" );
            $('#2').addClass( "checkedfor" );
            $('#1').addClass( "checkedfor" );    
        });                
            
        $(document).on('mouseover', '#2', function(){
            $('#2').addClass( "checkedfor" );
            $('#1').addClass( "checkedfor" );   
        });

        $(document).on('mouseout', '#5', function(){
            console.log('oi');
            $('#5').removeClass( "checkedfor" );
            $('#4').removeClass( "checkedfor" );
            $('#3').removeClass( "checkedfor" );
            $('#2').removeClass( "checkedfor" );
            $('#1').removeClass( "checkedfor" );
        });
            
        $(document).on('mouseout', '#4', function(){
            $('#4').removeClass( "checkedfor" );
            $('#3').removeClass( "checkedfor" );
            $('#2').removeClass( "checkedfor" );
            $('#1').removeClass( "checkedfor" );   
        });                 
            
        $(document).on('mouseout', '#3', function(){
            $('#3').removeClass( "checkedfor" );
            $('#2').removeClass( "checkedfor" );
            $('#1').removeClass( "checkedfor" );    
        });                
            
        $(document).on('mouseout', '#2', function(){
            $('#2').removeClass( "checkedfor" );
            $('#1').removeClass( "checkedfor" );   
        });

    </script>
@endsection