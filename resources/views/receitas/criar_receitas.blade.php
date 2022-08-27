@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main">
        <form method="POST" action="{{ route('cadastrar_receita') }}" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid row mx-0">
                <div class="container col-6">
                    <div class="card bg-transparent border-0 ">
                        <div class="card-body ">
                            <div class="text-center"> 
                                <label class="form-label fonteMaisFamosas">
                                    <h2>Titulo Da Receita</h2>     
                                </label>
                                <label class="form-label faltadados">
                                    <h6>{{$errors->has('titulo') ? $errors->first('titulo') : ''}}</h6>
                                </label>
                            </div>
                            <input type="text" name="titulo" class="form-control fonteCriarReceitas" name="titulo" id="exampleFormControlInput1" placeholder="coloque aqui seu titulo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid row-md mx-0">
                <div class="container col-6">
                    <div class="card bg-transparent  mb-5 border-0">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">Adicione&nbsp;a&nbsp;foto&nbsp;da&nbsp;sua&nbsp;receita</h3></label>
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
                            <h5>Sabores</h5>
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('sabor') ? $errors->first('sabor') : ''}}</h6>
                            </label>
                            <select class="form-select" aria-label="Default select example"  name="sabor" style="height: 50px;">
                                @foreach ($sabores as $item)
                                    <option value="{{$item->id}}">{{$item->sabor}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mx-auto col-6 ms-1">
                            <h5>Nacionalidade</h5>
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('nacionalidade') ? $errors->first('nacionalidade') : ''}}</h6>
                            </label>
                            <select class="form-select" aria-label="Default select example" name="nacionalidade" style="height: 50px" >
                                @foreach ($nacionalidades as $item)
                                    <option value="{{$item->id}}">{{$item->nacionalidade}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card bg-transparent mt-3 mb-5 border-0">                   
                        <div class="card-body height:114px ">
                            <label for="exampleFormControlTextarea1"  class="form-label ">
                                <h3 class="fonteMaisFamosas">Ingredientes</h3>
                            </label>
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('ingrediente') ? $errors->first('ingrediente') : ''}}</h6>
                            </label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Separe os ingredientes por virgula assim: Cebola, Tomate" name="ingrediente" style="resize: none; height:115.7px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="container col-6">
                    <div class="card bg-transparent mb-5 border-0">                   
                        <div class="card-body height:114px ">
                            <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">descrição</h3></label>
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('descricao') ? $errors->first('descricao') : ''}}</h6>
                            </label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="descreva brevemente a sua receita" name="descricao" style="resize: none; height:115.7px;"></textarea>
                        </div>
                    </div>
                    <div class="container  d-flex justify-content-center">    
                        <div class="mx-auto col-6 me-1">
                            <h5>Categoria</h5>
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('categoria') ? $errors->first('categoria') : ''}}</h6>
                            </label>
                            <select class="form-select" aria-label="Default select example" name="categoria" style="height: 3.1rem" placeholder="Categoria">
                                @foreach ($categorias as $item)
                                    <option value="{{$item->id}}">{{$item->categoria}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mx-auto col-3 ms-1">
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('tempo') ? $errors->first('tempo') : ''}}</h6>
                            </label>
                            <div class="d-inline-flex  bd-highlight" style="height: 3.1rem"></div>
                            <input type="number" class="form-control" name="tempo" id="exampleFormControlInput1" placeholder="Tempo Em Minutos" style="height: 3.1rem ;">    
                        </div>
                        <div class="mx-auto col-3 ms-1">
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('qtde_porcoes') ? $errors->first('qtde_porcoes') : ''}}</h6>
                            </label>
                            <div class="d-inline-flex  bd-highlight" style="height: 3.1rem"></div>
                            <input type="number" class="form-control" name="qtde_porcoes" id="exampleFormControlInput1" placeholder="Quantidade Em Numeros" style="height: 3.1rem ;" >    
                        </div>
                    </div>
                    <div class="card bg-transparent mt-3 mb-5 border-0">                   
                        <div class="card-body height:114px ">
                            <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">Modo De Preparo</h3></label>
                            <label class="form-label faltadados">
                                <h6>{{$errors->has('preparo') ? $errors->first('preparo') : ''}}</h6>
                            </label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Descreva como Preparar" name="preparo" style="resize: none; height:115.7px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center mx-auto col-2 mb-1 ">
                    <div class="text-center mx-0 ">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <input class="form-check-input me-1" name="mais_dezoito" type="checkbox" value="" id="firstCheckbox">
                                <label class="form-check-label" for="firstCheckbox">Receita +18</label>
                            </li>
                            <li class="list-group-item">
                                <input class="form-check-input me-1" name="escondida" type="checkbox" value="" id="secondCheckbox">
                                <label class="form-check-label" for="secondCheckbox">Escondida</label>
                            </li>
                        </ul>
                    </div>  
                </div>  
                <div class="container text-center mb-5">
                    <input class="btn btn-primary col-2 border-0" type="submit" value="Enviar" style="height:50px; background-color: #ff8c00; color:white">
                </div>
            </div>
        </form>
    </main>
@endsection