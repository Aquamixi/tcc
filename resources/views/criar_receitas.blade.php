@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main">
        <div class="container-fluid">
            <div class="container-fluid row ">
                <div class=" col-6 text-center ">
                    <div class=" h4"> 
                        Titulo Da Receita                        
                    </div>
                    <div class="">
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                </div>
                <div class="col-6 ">
                    <div class=" h4"> 
                        Titulo Da Receita                        
                    </div>
                    <div class="">
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                </div>  
            </div>
                
            <div class="container-fluid mt-5 row">
                <div class="col-6 text-center">
                    <div>
                        <div class="container">
                            <input type="file">
                        </div>

                    </div>
                </div>                                
                <div class="col-6 text-center ">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>"
            </div>

        </div>
    </main>
@endsection
@section('pos-script')
    <script type="text/javascript">
    </script>
@endsection