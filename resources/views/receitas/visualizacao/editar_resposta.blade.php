<form action="{{url('editar_resposta')}}" method="post">
    @csrf
    <input name="id" value="{{$linha->id}}" hidden>
    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Escreva aqui o seu comentario" name="resposta" style="resize: none; height:115.7px;">{{str_replace('<br />', "", $linha->resposta)}}</textarea>
</form>