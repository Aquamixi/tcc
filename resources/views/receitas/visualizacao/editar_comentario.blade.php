<form action="{{url('editar_comentario')}}" method="post">
    @csrf
    <input name="id" value="{{$linha->id}}" hidden>
    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Escreva aqui o seu comentario" name="comentario" style="resize: none; height:115.7px;">{{str_replace('<br />', "", $linha->comentario)}}</textarea>
    <div class="modal-footer">
        <button type="button" id="fecha" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        <input id="enviaComentario" class="btn btn-primary col-2 border-0" type="submit" value="Enviar" data-bs-dismiss="modal" style="height:40px; background-color: #ff8c00; color:white"/>
    </div>
</form>