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
                <div class="card col-12 " style=" ">
                    <div class="row m-1 mb-2">
                        <div>
                            <h6>Criador: {{$receita->usuario->name}}</h6>
                            <h6>Data Postagem: {{Carbon\Carbon::parse($receita->data_postagem)->format('d-m-Y')}}</h6>
                        </div>
                        <div class="col-md-4">
                            <img src="{{$receita->foto ? asset('foto_receitas/' . $receita->foto->anexo) : asset('foto_receitas/baiacu_2.0.png')}}" class="img-fluid rounded-start " style=" width: 400px; height: 230px;">
                        </div>
                        <div class="col-md-8 ms-0">
                            <div class="card-body">
                                <div class="container mt-3 row">
                                    <h5 class=" col-6">Velocidade: {{$receita->velocidade->velocidade}}</h5>
                                    <h5 class=" col-6 text-end">Quantidade Porções: {{$receita->qtde_porcoes}}</h5>
                                </div>
                                <div class="container mt-3">
                                    <h5 class="col-6">Nacionalidade: {{$receita->nacionalidade->nacionalidade}}</h5>
                                </div>
                                <div class="container mt-3">
                                    <h5 class="col-6">Sabor: {{$receita->sabor->sabor}}</h5>
                                </div>
                                <div class="container mt-3">
                                    <h5 class="col-6">Categoria: {{$receita->categoria->categoria}}</h5>
                                </div>
                                <div class="container mt-3 row">
                                    <div class=" col-6">
                                        <h5>Aprovação</h5>
                                        @for ($i = 0; $i < 5; $i++)
                                            @if (round($receita->avaliacao) <= $i)
                                                <button type="radio" class="fa fa-star botaostar"id="$i"></button>
                                            @else
                                                <button type="radio" class="fa fa-star checked botaostar" id="$i"></button>
                                            @endif
                                        @endfor
                                    </div>
                                    <h5 class=" col-6 text-end ">Compartilhar</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="fonteMaisFamosas mt-3">Descrição</h5>
                </div>
                <div class="card col-12  ">
                    <div class="card-body" style="height:170px;">
                        {{$receita->descricao}}
                    </div>
                </div>
                <div class="container  row mx-auto col-12">
                    <div class="container col-6 ">
                        <div>
                            <h5 class="fonteMaisFamosas mt-3">Ingredientes</h5>
                        </div>
                        <div class="card col-12  ">
                            <div class="card-body" style="height:170px;">
                                < id="estrelas">
                                    @foreach ($receita->ingrediente as $item)
                                        @if ($loop->last)
                                            {{$item->ingrediente}}
                                        @else
                                            {{$item->ingrediente}},
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="container col-6 ">
                        <div>
                            <h5 class="fonteMaisFamosas mt-3">Modo De Preparo</h5>
                        </div>
                        <div class="card col-12">
                            <div class="card-body" style="height:170px;">
                                {{$receita->modo_preparo}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>         
        </div>
    </main>
@endsection

@section('pos-script')
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script>
        const botaoestrelas = event.target.querySelector($i);
        const estrelas = (botaoestrelas.value);
        console.log($i);
    </script>
@endsection