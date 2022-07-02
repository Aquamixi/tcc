@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')

    <main role="main" class="fundobom">
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
                    @foreach ($receitas as $receita)
                        <div class="card me-3 mb-3" style="width: 18rem;">
                            <img class="pt-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdcxE6OZOeD3WJ8ZSLWkrYMjnyp7Vs2oPqKQ&usqp=CAU" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{$receita->titulo_receita}}
                                </h5>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade bg-transparent" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                <div class="card-body justify-content-center mx-0 row">
                    @foreach ($usuarios as $receita)
                        <div class="card me-3 mb-3" style="width: 18rem;">
                            <img class="pt-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdcxE6OZOeD3WJ8ZSLWkrYMjnyp7Vs2oPqKQ&usqp=CAU" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{$receita->titulo_receita}}
                                </h5>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection