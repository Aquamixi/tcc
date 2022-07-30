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
                                <img src="{{$item->foto->anexo}}"  height="400px" width="300px" class="d-block w-100" >
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{$item->titulo_receita}}</h5>
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

        <div class="container-fluid bg-transparent row">
            <div class="ms-1"><h2 class="fonteMaisFamosas">Mais Famosas</h2></div>
            <div class="container col-9 p-2 m-2">
                @foreach ($receitas as $receita)
                    <div class="card mb-3 col-10" style="max-width: 800px; min-width: 200px">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="{{$receita->foto->anexo}}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title">{{$receita->sabor->sabor}}</h5>
                                    <p class="card-text">{{$receita->titulo_receita}}</p>
                                    <p class="card-text">{{$receita->categoria->sub_categoria->sub_categoria}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>                

            <div class="container-fluid col-2 ms-md-auto p-2 m-2 bg-transparent">
                <ul class="list-group div1">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item teste">And a fifth one</li>
                </ul>
            </div>
            <div class="div1">

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

@endsection
@section('pos-script')
    <script type="text/javascript">
        var first = {{$first_login}};

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

    </script>
@endsection