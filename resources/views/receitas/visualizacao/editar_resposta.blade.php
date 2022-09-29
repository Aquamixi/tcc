<form action="{{url('editar_resposta')}}" method="post">
    @csrf
    <input id="resposta_id" name="id" value="{{$linha->id}}" hidden>
    {!! Form::textarea('resposta', str_replace('<br />', "", $linha->resposta), ['id' => 'nova_resposta', 'class' => 'form-control textarea-100 autoExpand', 'placeholder' => '...', 'rows' => count(preg_split('/\n|\r|<br \/>/',$linha->resposta))]) !!}
</form>