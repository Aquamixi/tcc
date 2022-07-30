@extends('layouts.app')

@section('titulo', 'MyRecipes')


@section('conteudo')

    <main>
        <div class="container">
            <div class="container p-3">
                <div class="fonteMaisFamosas text-center"> 
                    <h2>Titulo Da Receita</h2>                       
                </div>
            </div>
            <div class="container row">
                <div class="card col-12 " style=" ">
                    <div class="row m-1 mb-4">
                        <div>
                            <h6> Nome do cara logo pra caralho tipo isso</h6>
                        </div>
                        <div class="col-md-4">
                            <img src="https://s2.glbimg.com/7o51Cl7EkgutScXm_VwFeJA8nD4=/e.glbimg.com/og/ed/f/original/2020/03/03/tubarao-duende.jpg" class="img-fluid rounded-start " style=" width: 400px; height: 230px;">
                        </div>
                        <div class="col-md-8 ms-0">
                            <div class="card-body">
                                <div class="container mt-3 row">
                                    <h5 class=" col-6">Velocidade</h5>
                                    <h5 class=" col-6 text-end">Quantidade Porções</h5>
                                </div>
                                <div class="container mt-3">
                                    <h5 class="col-6">Nacionalidade</h5>
                                </div>
                                <div class="container mt-3">
                                    <h5 class="col-6">Sabor</h5>
                                </div>
                                <div class="container mt-3">
                                    <h5 class="col-6">Categoria</h5>
                                </div>
                                <div class="container mt-3 row">
                                    <h5 class=" col-6">Estrelas</h5>
                                    <h5 class=" col-6 text-end">Compartilhar</h5>
                                </div>
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
@endsection