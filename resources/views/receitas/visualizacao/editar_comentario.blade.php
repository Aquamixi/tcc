<form action="{{url('editar_comentario')}}" method="post">
    @csrf
    <input name="id" value="{{$linha->id}}" id="comentario_id_editar" hidden>
    {!! Form::textarea('comentario', str_replace('<br />', "", $linha->comentario), ['id' => 'novo_comentario', 'class' => 'form-control textarea-100 autoExpand', 'placeholder' => '...', 'rows' => count(preg_split('/\n|\r|<br \/>/',$linha->comentario))]) !!}
</form>