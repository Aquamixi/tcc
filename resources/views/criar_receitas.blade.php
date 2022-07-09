@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main">
        <div class="  container-fluid  ">
            <div class="container card-group  p-4 col-12 ">
                <div class="card bg-transparent border-0 ">
                    <div class="card-body">
                        <div class="text-center">
                            <div class=" h4"> 
                                Titulo Da Receita                        
                            </div>
                            <div class="">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container card-group text-center  justify-content-center ">
                <div class="card p-3 m-2 col-6 bg-transparent border-0">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1" class="form-label">Adicione a porra da sua foto</label>
                        <div class="card">
                            <div class="card-body " style="height:86px;" >
                                <div class="mb-3">
                                    <label for="formFileLg" class="form-label">Large file input example</label>
                                    <input class=" form-control position-absolute bottom-0 start-0 form-control form-control-lg" id="formFileLg" style="height: 86px" type="file">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="card p-3 m-2 col-6 bg-transparent border-0">                   
                    <div class="card-body  ">
                        <label for="exampleFormControlTextarea1" class="form-label">Aqui vai a porra da descricao</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Minha receita é um bolo de cocaina" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('pos-script')
    <script type="text/javascript">
    </script>
@endsection