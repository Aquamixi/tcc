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
                <div class="col-6 text-center ">
                    <label for="exampleFormControlTextarea1" class="form-label">Aqui vai a porra da descricao</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Minha receita é um bolo de cocaina" rows="3"></textarea>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('pos-script')
    <script type="text/javascript">
    </script>
@endsection