@extends('layouts.app')

@section('titulo', 'Login')

@section('conteudo')

<main role="main">
    <div class="container-fluid row align-items-start">
        <div class="container" style="height: 600px">
            <div class="container mt-5 p-2">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
            
                                    <div class="form-group p-3 row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group p-3 row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group p-2 row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Mantenha-me Conectado') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group p-1 row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn" style="background-color: #ff8c00; color:white">
                                                {{ __('Entrar') }}
                                            </button>
            
                                                <a class="btn btn-link" href="{{ route('reseta') }}">
                                                    {{ __('Esqueceu sua Senha?') }}
                                                </a>
                                        </div>
                                    </div>
                                </form>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end me-3">
                                    <a type="button" class="btn" style="background-color: #ff8c00; color:white" href="{{url('/register')}}">Registre-se</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</main>

@endsection
