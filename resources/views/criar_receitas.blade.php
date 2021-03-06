@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main">
        <form method="POST" action="{{ route('cadastrar_receita') }}">
            @csrf
            <div class="container-fluid row mx-0">
                <div class="container col-6">
                    <div class="card bg-transparent border-0 ">
                        <div class="card-body ">
                            <div class="fonteMaisFamosas text-center"> 
                                <h2>Titulo Da Receita</h2>                       
                            </div>
                            <input type="text" class="form-control fonteCriarReceitas" name="titulo" id="exampleFormControlInput1" placeholder="coloque aqui seu titulo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid row mx-0">
                <div class="container col-6">
                    <div class="card bg-transparent  mb-5 border-0">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">Adicione a foto da sua receita</h3></label>
                            <div class="card">
                                <div class="card-body " style="height:114px;" >
                                    <div class="mb-3">
                                        <label for="formFileLg" class="form-label">Large file input example</label>
                                        <input class=" form-control position-absolute bottom-0 start-0 form-control form-control-lg" id="formFileLg" name="imagem" style="height: 114px" type="file">
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="container  d-flex justify-content-center">               
                        <div class="mx-auto col-6 me-1">
                            <select class="form-select" aria-label="Default select example" style="height: 50px; ">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mx-auto col-6 ms-1">
                            <select class="form-select" aria-label="Default select example" style="height: 50px">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="card bg-transparent mt-3 mb-5 border-0">                   
                        <div class="card-body height:114px ">
                            <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">descri????o</h3></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="descrva brevemente a sua receita" name="descricao" style="resize: none; height:115.7px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="container col-6">
                    <div class="card bg-transparent mb-5 border-0">                   
                        <div class="card-body height:114px ">
                            <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">descri????o</h3></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="descrva brevemente a sua receita"  style="resize: none; height:115.7px;"></textarea>
                        </div>
                    </div>
                    <div class="container  d-flex justify-content-center">    
                        <div class="mx-auto col-6 me-1">
                            <select class="form-select" aria-label="Default select example" style="height: 50px; ">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mx-auto col-6 ms-1">
                            <select class="form-select" aria-label="Default select example" style="height: 50px; ">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="card bg-transparent mt-3 mb-5 border-0">                   
                        <div class="card-body height:114px ">
                            <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">descri????o</h3></label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Minha receita ?? um bolo de cocaina"  style="resize: none; height:115.7px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="container text-center mb-5">
                    <input class="btn btn-primary col-2 border-0" type="submit" value="Enviar" style="height:50px; background-color: #ff8c00; color:white">
                </div>
            </div>
        </form>
    </main>
    @endsection
@section('pos-script')
    <script type="text/javascript">
    </script>
@endsection