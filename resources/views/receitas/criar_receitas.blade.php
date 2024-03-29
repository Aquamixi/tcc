@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main">
        <form method="POST" action="{{ route('cadastrar_receita') }}" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid row mx-0">
                <div class="container col-6">
                    <div class="card bg-transparent border-0">
                        <div class="card-body">
                            <div class="text-center"> 
                                <label class="form-label fonteMaisFamosas">
                                    <h2>Titulo Da Receita</h2>     
                                </label>
                                <label class="form-label faltadados">
                                    <h6>{{$errors->has('titulo') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <input style="height: 50px" type="text" name="titulo" class="form-control fonteCriarReceitas" value="{{old('titulo')}}" name="titulo" id="exampleFormControlInput1" placeholder="coloque aqui seu titulo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid row-md mx-0">
                <div class="container col-6">
                    <div class="card bg-transparent mb-2 border-0">
                        <div class="card-body">
                            <center>
                                <label for="exampleFormControlTextarea1" class="form-label"><h3 class="fonteMaisFamosas">Adicione&nbsp;a&nbsp;foto&nbsp;da&nbsp;sua&nbsp;receita</h3></label>
                                <label class="picture" for="picture__input" tabIndex="0">
                                    <span class="picture__image"></span>
                                </label>                              
                                <input type="file" name="imagem" id="picture__input" >
                            </center>
                        </div>
                    </div>
                    <div class="container d-flex justify-content-center">               
                        <div class="mx-auto col-6 me-1">
                            <div class="row">
                                <h3 class="fonteMaisFamosas col-6">Sabor</h3>
                                <label class="form-label faltadados col-5">
                                    <h6>{{$errors->has('sabor') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <select class="form-select" aria-label="Default select example" name="sabor" style="height: 50px;">
                                @foreach ($sabores as $item)
                                    @if (old('sabor') == $item->id)
                                        <option value="{{old('sabor')}}" selected>{{$item->sabor}}</option>
                                    @else
                                        <option value="{{$item->id}}" >{{$item->sabor}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mx-auto col-6 ms-1">
                            <div class="row">
                                <h3 class="fonteMaisFamosas col-6">Nacionalidade</h3>
                                <label class="form-label faltadados col-6 text-end">
                                    <h6 >{{$errors->has('nacionalidade') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <input class="form-control" aria-label="Default select example" list="datalistOptions" value="{{old('nacionalidade')}}" name="nacionalidade" style="height: 50px" />
                            <datalist id="datalistOptions">
                                @foreach ($nacionalidades as $item)
                                    <option value="{{$item->nacionalidade}}">{{$item->nacionalidade}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="card bg-transparent mt-3 border-0">                   
                        <div class="card-body height:114px">
                            <div class="row">                              
                                <label for="exampleFormControlTextarea1" class="form-label col-6">
                                    <h3 class="fonteMaisFamosas">Ingredientes</h3>
                                </label>
                                <label class="form-label faltadados col-5">
                                    <h6>{{$errors->has('ingrediente') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Separe os ingredientes por virgula assim: Cebola, Tomate" name="ingrediente" style="resize: none; height:115.7px;">{{old('ingrediente') ? old('ingrediente') : ''}}</textarea>
                        </div>
                    </div>
                    <div class="card bg-transparent border-0">                   
                        <div class="card-body height:114px">
                            <div class="row">                             
                                <h3 class="fonteMaisFamosas col-6">Modo De Preparo</h3>
                                <label class="form-label faltadados col-5">
                                    <h6>{{$errors->has('preparo') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Descreva como Preparar" name="preparo" style="resize: none; height:115.7px;">{{old('preparo') ? old('preparo') : ''}}</textarea>
                        </div>
                    </div>
                    <div class="container d-flex mt-2 justify-content-center">    
                        <div class="col-12">
                            <div class="row">                            
                                <h3 class="fonteMaisFamosas col-6">Categoria</h3>
                                <label class="form-label faltadados col-5">
                                    <h6>{{$errors->has('categoria') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <select class="form-select" aria-label="Default select example" name="categoria" style="height: 3.1rem" placeholder="Categoria">
                                @foreach ($categorias as $item)
                                    @if (old('categoria') == $item->id)
                                        <option value="{{old('categoria')}}" selected>{{$item->categoria}}</option>
                                    @else
                                        <option value="{{$item->id}}" >{{$item->categoria}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="container mt-2 col-6">
                    <div class="card bg-transparent border-0">                   
                        <div class="card-body height:114px">
                            <div class="row">                              
                                <label for="exampleFormControlTextarea1" class="form-label col-6"><h3 class="fonteMaisFamosas">Descrição</h3></label>
                                <label class="form-label faltadados col-5">
                                    <h6>{{$errors->has('descricao') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Descreva brevemente a sua receita" name="descricao" style="resize: none; height:115.7px;">{{old('descricao') ? old('descricao') : ''}}</textarea>
                        </div>
                    </div>
                    <div class="container mt-2 d-flex justify-content-center">
                        <div class="mx-auto col-6 ms-1">
                            <div class="row">
                                <h3 class="fonteMaisFamosas col-6">Tempo&nbsp;Preparo</h3>
                                <label class="form-label faltadados text-end col-6">
                                    <h6>{{$errors->has('tempo') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <input type="number" class="form-control" name="tempo" value="{{old('tempo')}}" id="exampleFormControlInput1" placeholder="Tempo em Minutos" style="height: 3.1rem ;">    
                        </div>
                        <div class="mx-auto col-6 ms-1">
                            <div class="row">
                                <h3 class="fonteMaisFamosas col-6">Servem</h3>
                                <label class="form-label faltadados col-5">
                                    <h6>{{$errors->has('qtde_porcoes') ? "Obrigatório" : ''}}</h6>
                                </label>
                            </div>
                            <input type="number" class="form-control" name="qtde_porcoes" value="{{old('qtde_porcoes')}}" id="exampleFormControlInput1" placeholder="Quantidade de Pessoas" style="height: 3.1rem ;" >    
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center pt-4 ">
                    <div class="text-center col-2 mb-1">
                        <div class="text-center mx-0">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    @if (old('mais_dezoito'))
                                        <input class="form-check-input" checked name="mais_dezoito" type="checkbox" id="firstCheckbox">
                                    @else
                                        <input class="form-check-input" name="mais_dezoito" type="checkbox" id="firstCheckbox">
                                    @endif
                                    <label class="form-check-label" for="firstCheckbox">Receita +18</label>
                                </li>
                            </ul>
                        </div>  
                    </div>  
                    <div class="text-center col-2 mb-1">
                        <div class="text-center mx-0">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    @if (old('escondida'))
                                        <input class="form-check-input" name="escondida" checked type="checkbox" id="secondCheckbox">
                                    @else
                                        <input class="form-check-input" name="escondida" type="checkbox" id="secondCheckbox">
                                    @endif
                                    <label class="form-check-label" for="secondCheckbox">Escondida</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container text-center pb-4 pt-4">
                    <input class="btn btn-primary col-2 border-0" type="submit" value="Enviar" style="height:50px; background-color: #ff8c00; color:white">
                </div>
            </div>
        </form>
    </main>
@endsection
@section('pos-script')
    <script type="text/javascript">
        const inputFile = document.querySelector("#picture__input");
        const pictureImage = document.querySelector(".picture__image");
        const pictureImageTxt = "<img height='150px' src='{{asset("foto_receitas/baiacu_2.0.png")}}'>" ;
        pictureImage.innerHTML = pictureImageTxt;

        inputFile.addEventListener("change", function (e) {
        const inputTarget = e.target;
        const file = inputTarget.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener("load", function (e) {
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src = readerTarget.result;
            img.classList.add("picture__img");

            pictureImage.innerHTML = "";
            pictureImage.appendChild(img);
            });

            reader.readAsDataURL(file);
        } else {
            pictureImage.innerHTML = pictureImageTxt;
        }
        });
    </script>
@endsection