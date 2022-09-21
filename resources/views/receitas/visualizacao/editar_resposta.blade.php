<form action="{{url('editar_resposta')}}" method="post">
    @csrf
    <input id="resposta_id" name="id" value="{{$linha->id}}" hidden>
    <textarea class="form-control" id="nova_resposta" placeholder="Escreva aqui o seu comentario" name="resposta" style="resize: none; height:115.7px;">{{str_replace('<br />', "", $linha->resposta)}}</textarea>
</form>