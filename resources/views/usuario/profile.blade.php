@if (Auth::user()->id == $usuario->id)
    {{$usuario}}
@else
    {{$usuario->name}} - {{Auth::user()->id}}
@endif