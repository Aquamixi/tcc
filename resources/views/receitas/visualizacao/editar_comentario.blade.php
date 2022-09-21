<form action="{{url('editar_comentario')}}" method="post">
    @csrf
    <input name="id" value="{{$linha->id}}" id="comentario_id_editar" hidden>
    <textarea class="form-control" id="novo_comentario" placeholder="Escreva aqui o seu comentario" name="comentario" style="resize: none; height:115.7px;">{{str_replace('<br />', "", $linha->comentario)}}</textarea>
</form>