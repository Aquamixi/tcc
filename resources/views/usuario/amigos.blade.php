@extends('layouts.app')
@section('titulo', 'MyRecipes')
@section('conteudo')
    <main role="main">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-light bg-transparent" id="seguindo-tab" data-bs-toggle="tab" data-bs-target="#seguindo" type="button" role="tab" aria-controls="seguindo" aria-selected="true">
                    Seguindo
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-light bg-transparent" id="seguidores-tab" data-bs-toggle="tab" data-bs-target="#seguidores" type="button" role="tab" aria-controls="seguidores" aria-selected="false">
                    Seguidores
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active bg-transparent" id="seguindo" role="tabpanel" aria-labelledby="seguindo-tab">
                <div class="card-body justify-content-center mx-0 row">
                    @if (count($seguindo) == 0)
                        <p>Este Usuário Ainda Não Segue Ninguém</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    Seguindo
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seguindo as $segue)
                                    <tr>
                                        <td>
                                            <img class="rounded-circle" src="{{$segue->usuario->foto ? asset('foto_usuario' . '/' . $segue->usuario->foto->anexo) : asset('foto_usuario/baiacu_2.0.jpg')}}" width="32" height="32">
                                        </td>
                                        <td>
                                            <a href="{{url('profile')}}/{{$segue->usuario_id}}" style="text-decoration: none; color: black">
                                                {{$segue->usuario->name}}
                                            </a>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            @unless (Auth::user()->id == $segue->usuario_id)
                                                @if(in_array($segue->usuario_id, $array_seguindo))
                                                    <a data-usuario="{{$segue->usuario_id}}" class="deixar_seguir" title="Deixar de Seguir">
                                                        <i class="fa-solid fa-user-check"></i>
                                                    </a>
                                                @else
                                                    <a data-usuario="{{$segue->usuario_id}}" class="seguir" title="Seguir">
                                                        <i class="fa-solid fa-user-plus"></i>
                                                    </a>
                                                @endif
                                            @endunless
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade bg-transparent" id="seguidores" role="tabpanel" aria-labelledby="seguidores-tab">
                <div class="card-body justify-content-center mx-0 row">
                    @if (count($seguidores) == 0)
                        <p>Sem Seguidores</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>Seguidores</tr>
                            </thead>
                            <tbody>
                                @foreach ($seguidores as $segue)
                                    <tr>
                                        <td>
                                            <img class="rounded-circle" src="{{$segue->seguidor->foto ? asset('foto_usuario' . '/' . $segue->seguidor->foto->anexo) : asset('foto_usuario/baiacu_2.0.jpg')}}" width="32" height="32">
                                        </td>
                                        <td>
                                            <a href="{{url('profile')}}/{{$segue->seguidor_id}}" style="text-decoration: none; color: black">
                                                {{$segue->seguidor->name}}
                                            </a>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            @unless (Auth::user()->id == $segue->seguidor_id)
                                                @if(in_array($segue->seguidor_id, $array_seguindo))
                                                    <a data-usuario="{{$segue->seguidor_id}}" class="deixar_seguir" title="Deixar de Seguir">
                                                        <i class="fa-solid fa-user-check"></i>
                                                    </a>
                                                @else
                                                    <a data-usuario="{{$segue->seguidor_id}}" class="seguir" title="Seguir">
                                                        <i class="fa-solid fa-user-plus"></i>
                                                    </a>
                                                @endif
                                            @endunless
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <div class="NoCanto" id="alerta_sucesso_seguir" hidden>
        <div class="alert alert-success" role="alert">
            Você começou a segui-lo(a)!
        </div>
    </div>

    <div class="NoCanto" id="alerta_sucesso_deixar_seguir" hidden>
        <div class="alert alert-success" role="alert">
            Você deixou de segui-lo(a)!
        </div>
    </div>
@endsection

@section('pos-script')
    <script type="text/javascript">
        $(document).on('click', '.seguir', function(){
            $.ajax({
                type: 'POST', 
                url: "{{ url('seguir') }}", 
                data: { 
                    id: $(this).data('usuario'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alerta_sucesso_seguir').prop('hidden', false);

                    $('#alerta_sucesso_seguir').fadeOut(5000);

                    setTimeout(() => {
                        $('#alerta_sucesso_seguir').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });

        $(document).on('click', '.deixar_seguir', function(){
            $.ajax({
                type: 'POST', 
                url: "{{ url('deixar_seguir') }}", 
                data: { 
                    id: $(this).data('usuario'),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(){
                    $('#alerta_sucesso_deixar_seguir').prop('hidden', false);

                    $('#alerta_sucesso_deixar_seguir').fadeOut(5000);

                    setTimeout(() => {
                        $('#alerta_sucesso_deixar_seguir').remove()
                        window.location.reload(true);
                    }, 5050);
                }
            });
        });
    </script>
@endsection