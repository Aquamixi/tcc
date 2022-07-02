@extends('layouts.app')

@section('titulo', 'MyRecipes')

@section('conteudo')
    <main role="main">
            <div class="container justify-content-center row">
                <div class=" col-6">
                    <div class="div h4"> 
                        Titulo Da Receita                        
                    </div>
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Titulo Receita"aria-label="">
                    </div>
                </div>
                <div class=" col-6  ">
                    <div class="div h4"> 
                        Titulo Da Receita                        
                    </div>
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Titulo Receita"aria-label="">
                    </div>
                </div>  
                <div class="div container">        
                    <div class="form-floating col-5 ">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>                                
                    <div class="form-floating col-5 ">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>
                </div>
            </div>
    </main>
@endsection
@section('pos-script')
    <script type="text/javascript">
    </script>
@endsection