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
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdcxE6OZOeD3WJ8ZSLWkrYMjnyp7Vs2oPqKQ&usqp=CAU"  height="400px" width="300px" class="d-block w-100" >
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
            <div><h2>Mais Famosas</h2></div>
            <div class="container col-9 p-2 m-2">
                @foreach ($receitas as $receita)
                    <div class="card mb-3 col-10" style="max-width: 800px; min-width: 200px">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="https://static1.purepeople.com.br/articles/6/14/83/86/@/1825631-silvio-santos-comentou-a-previsao-de-cig-234x175-2.jpg" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>                

            <div class="container-fluid col-2 ms-md-auto p-2 m-2 bg-transparent">
                <ul class="list-group">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                </ul>
            </div>
        </div>
    </main>
@endsection