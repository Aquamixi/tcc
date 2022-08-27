@extends('layouts.app')

    @section('titulo', 'MyRecipes')
    @section('conteudo')
        <main role="main">
            <div class="container nav row">
                <div class="container col-3">
                        <div class="card mt-2" style="min-width:142px ">
                            <div class="card-body mx-auto">
                                <div class="btn-group-vertical ">
                                    <button type="button" class="btn btn-outline-warning mt-3" >Perfil</button>
                                    <button type="button" class="btn btn-outline-warning mt-3" >Receitas</button>
                                    <button type="button" class="btn btn-outline-warning mt-3" >Receitas Curtidas</button>
                                    <button type="button" class="btn btn-outline-warning mt-3" >Receitas Favoritas</button>
                                    <button type="button" class="btn btn-outline-warning mt-3 mb-3" >Detalhes Conta</button>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="container m-2 col-8">
                    <div class="card mb-3" >
                        <div class="row g-0 m-4">
                            <div class="col-md-4 ">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSU6xHSdzHFBr_BfjyYBYkcCf4_o_KnP5QiQ&usqp=CAU" class="img-fluid rounded-start" height="500px">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="container mt-3 row">
                                        <h5 class=" col-6 ">nome</h5>
                                        <h5 class=" col-6 text-end">idade</h5>
                                    </div>
                                    <div class="container mt-3 row">
                                        <h5 class="col-6">email</h5>
                                    </div>
                                    <div class="container mt-3 row">
                                        <h5 class="col-6">Entrou Em</h5>
                                        <h5 class=" col-6 text-end">idade</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endsection
