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
                                <a title="comentar" class="comentar" id="comentar"><i class="fa-solid fa-comment"></i></a>
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
                    @if (count($receita->comentario) > 0)
                        <div class="">
                            <h5 class="fonteMaisFamosas">Comentarios</h5>
                        </div>
                        @foreach ($receita->comentario as $item)
                            <div class="card col-12 mb-3">
                                <div class="card-header row">
                                    <h5 class="col-6 mt-2">{{$item->usuario->name}}</h5>                          
                                    <h5 class="col-5 mt-2 text-end">{{Carbon\Carbon::parse($item->data_comentario)->format('d-m-Y')}}</h5>                           
                                    <h5 class="col-1 mt-2 text-end">
                                        <div class="dropend">
                                            <button type="button" class="border-0 bg-transparent dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu text-center">
                                                @if (Auth::user()->id == $item->user_id)
                                                    <li><button class="btn bg-transparent" data-id="{{$item->id}}" id="excluir_comentario" type="submit"><i class="fa-solid fa-trash"></i> Excluir</button></li>
                                                    @if (Carbon\Carbon::today()->diffInHours(Carbon\Carbon::parse($item->data_comentario), false) < 24 and Carbon\Carbon::today()->diffInHours(Carbon\Carbon::parse($item->data_comentario), false) > 0)
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><button class="btn bg-transparent" data-id="{{$item->id}}" id="editar_comentario" type="submit"><i class="fa-solid fa-pen"></i> Editar</button></li>
                                                    @endif
                                                @endif
                                            </ul>
                                        </div>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <h5>
                                        {!! $item->comentario !!}
                                    </h5>
                                </div>
                                <div class="card-footer row">
                                    <h5 class="col-10">
                                        @if (count($item->respostas) > 0)
                                            <button style="background-color: #ff8c00; color:white" class="btn btn-link respostas" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$item->id}}" aria-expanded="false" aria-controls="collapseExample">
                                                Respostas: {{$item->respostas->count()}}
                                            </button>
                                        @endif
                                    </h5>
                                    <h5 class="col-1 text-end mt-2">
                                        @if (count($item->curtida_user) > 0)
                                            <a title="Descurtir" class="curtido" id="descurtircomentario" data-id="{{$item->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                        @else
                                            <a title="Curtir" class="botaocurtir" id="curtircomentario" data-id="{{$item->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                        @endif
                                    </h5>
                                    <h5 class="col-1 text-end mt-2">
                                        <a title="Responder" class="comentar" id="responder" data-comentario_id="{{$item->id}}"><i class="fa-solid fa-comments"></i></a>
                                    </h5>
                                    <div class="collapse" id="collapseExample{{$item->id}}">
                                        @foreach ($item->respostas as $r)
                                            <div class="card mb-2">                                    
                                                <div class="row card-header mx-0">
                                                    <h6 class="col-2 mt-2 text-start">{{Carbon\Carbon::parse($item->data_comentario)->format('d-m-Y')}}</h6>        
                                                    <h6 class="col-8 mt-2 text-center">{{$r->usuario->name}}</h6>
                                                    <h6 class="col-1 mt-2 text-end">
                                                        @if (count($r->curtida_user) > 0)
                                                        <a title="Descurtir" class="curtido" id="descurtir_resposta" data-id="{{$r->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                                        @else
                                                        <a title="Curtir" class="botaocurtir" id="curtir_resposta" data-id="{{$r->id}}"><i class="fa-solid fa-thumbs-up"></i></a>
                                                        @endif
                                                    </h6>     
                                                    <h6 class="col-1 mt-2 text-end">
                                                        <div class="dropend">
                                                            @if (Auth::user()->id == $r->user_id)
                                                                <button type="button" class="border-0 bg-transparent dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                </button>
                                                                <ul class="dropdown-menu text-center">
                                                                    <li><button class="btn bg-transparent" data-id="{{$r->id}}" id="excluir_resposta" type="submit"><i class="fa-solid fa-trash"></i> Excluir</button></li>
                                                                    @if (Carbon\Carbon::today()->diffInHours(Carbon\Carbon::parse($r->data_resposta), false) < 24 and Carbon\Carbon::today()->diffInHours(Carbon\Carbon::parse($r->data_resposta), false) > 0)
                                                                        <li><hr class="dropdown-divider"></li>
                                                                        <li><button class="btn bg-transparent" data-id="{{$r->id}}" id="editar_resposta" type="submit"><i class="fa-solid fa-pen"></i> Editar</button></li>
                                                                    @endif
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </h6>                                   
                                                </div>   
                                                <div class="card-body">
                                                    {!! $r->resposta !!}
                                                </div>                                
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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

    <div class="modal fade" id="modalEComentario" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fonteMaisFamosas">Editar Comentario</h3>
                </div>
                <input id="id_comentario" hidden>
                <div class="modal-body editar-body">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalResponder" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fonteMaisFamosas">Responder</h3>
                </div>
                <input id="comentario_id" hidden>
                <input value="{{$receita->id}}" id="id_da_receita" hidden>
                <div class="modal-body">
                    <textarea class="form-control" placeholder="Escreva aqui a sua resposta" id="resposta" name="resposta" style="resize: none; height:115.7px;">{{old('resposta') ? old('resposta') : ''}}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="fecha" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                    <input id="enviaResposta" class="btn btn-primary col-2 border-0" type="submit" value="Enviar" data-bs-dismiss="modal" style="height:40px; background-color: #ff8c00; color:white"/>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEResposta" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fonteMaisFamosas">Editar Resposta</h3>
                </div>
                <input id="id_comentario" hidden>
                <div class="modal-body editar_r-body">
                </div>
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

    <div class="NoCanto" id="alertaSucessoResposta" hidden>
        <div class="alert alert-success" role="alert">
            Comentario Respondido Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoCurtircomentario" hidden>
        <div class="alert alert-success" role="alert">
            Comentario Curtido Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoDesCurtircomentario" hidden>
        <div class="alert alert-success" role="alert">
            Comentario Descurtido Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoExcluirComentario" hidden>
        <div class="alert alert-success" role="alert">
            Comentario Excluído Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoEditarComentario" hidden>
        <div class="alert alert-success" role="alert">
            Comentario Editado Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoCurtirresposta" hidden>
        <div class="alert alert-success" role="alert">
            Resposta Curtida Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoDesCurtirresposta" hidden>
        <div class="alert alert-success" role="alert">
            Resposta Descurtida Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoExcluirresposta" hidden>
        <div class="alert alert-success" role="alert">
            Resposta Excluída Com Sucesso!
        </div>
    </div>

    <div class="NoCanto" id="alertaSucessoComentar" hidden>
        <div class="alert alert-success" role="alert">
            Receita Comentada Com Sucesso!
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

        $(document).on('click', '#responder', function(e){
            e.preventDefault();
            var id_do_comentario = $(this).data('comentario_id');
            $("#modalResponder").modal('show');
            $('#comentario_id').val(id_do_comentario);
        });
        
        $(document).on('click', '#enviaResposta', function(){
            $('#enviaResposta').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('responder_comentario') }}", 
                data: { 
                    id: $('#id_da_receita').val(),
                    comentario_id: $('#comentario_id').val(),
                    resposta: $('#resposta').val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoResposta').prop('hidden', false);
                    $('#alertaSucessoResposta').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoResposta').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
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

        const urlParams = new URLSearchParams(window.location.search);
        const comentado = urlParams.get('comentado');

        if(comentado == 'comentado'){
            $(document).ready(function(){
                $('#alertaSucessoComentar').prop('hidden', false);
                $('#alertaSucessoComentar').fadeOut(5000);
                setTimeout(() => {
                    $('#alertaSucessoComentar').remove()
                }, 5050);
            });
        }

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

        $(document).on('click', '#curtircomentario', function(){
            $('#curtircomentario').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('curtir_comentario') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoCurtircomentario').prop('hidden', false);
                    $('#alertaSucessoCurtircomentario').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoCurtircomentario').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#descurtircomentario', function(){
            $('#descurtircomentario').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('descurtir_comentario') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoDesCurtircomentario').prop('hidden', false);
                    $('#alertaSucessoDesCurtircomentario').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoDesCurtir').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#excluir_comentario', function(){
            $('#excluir_comentario').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('excluir_comentario') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoExcluirComentario').prop('hidden', false);
                    $('#alertaSucessoExcluirComentario').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoExcluirComentario').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#editar_comentario', function(){
            $("#modalEComentario").modal('show');
            $.ajax({
                type: 'GET', 
                url: "{{ url('visualizar_comentario_edicao') }}", 
                data: {
                    id: $(this).data('id')
                },
                success: function(data){
                    $('.editar-body').html(data);
                }
            });
        });

        $(document).on('click', '#editar_resposta', function(){
            $("#modalEResposta").modal('show');
            $.ajax({
                type: 'GET', 
                url: "{{ url('visualizar_resposta_edicao') }}", 
                data: {
                    id: $(this).data('id')
                },
                success: function(data){
                    $('.editar_r-body').html(data);
                }
            });
        });

        $(document).on('click', '#curtir_resposta', function(){
            $('#curtir_resposta').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('curtir_resposta') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoCurtirresposta').prop('hidden', false);
                    $('#alertaSucessoCurtirresposta').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoCurtirresposta').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#descurtir_resposta', function(){
            $('#descurtir_resposta').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('descurtir_resposta') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoDesCurtirresposta').prop('hidden', false);
                    $('#alertaSucessoDesCurtirresposta').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoDesCurtirresposta').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '#excluir_resposta', function(){
            $('#excluir_resposta').prop('disabled', true);
            $.ajax({
                type: 'POST', 
                url: "{{ url('excluir_resposta') }}", 
                data: { 
                    id: $(this).data('id'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alertaSucessoExcluirresposta').prop('hidden', false);
                    $('#alertaSucessoExcluirresposta').fadeOut(5000);
                    setTimeout(() => {
                        $('#alertaSucessoExcluirresposta').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });
    </script>
@endsection