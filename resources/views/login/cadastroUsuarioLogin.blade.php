@extends('layouts.app') 

@section('content')
    <body class="fundoCadastro">

        @isset($semCadastro)
        <div class="container mt-5" style="width: 50%">
            <div class="card border-warning mb-3">
                <div class="card-header bg-warning text-dark">
                    Atenção
                </div>
                <div class="card-body">
                    <h5 class="card-title">Importante!</h5>
                    <p class="card-text">
                        {{$semCadastro}}
                    </p>
                </div>
            </div>
        </div>
            
        @endisset
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card"> 
                    <div class="card-header bg-custom">
                        {{ __('Cadastro de Usuário') }}&nbsp;&nbsp;&nbsp;😁
                    </div>

                    <div class="card-body fundoCard">
                        <form method="POST" action="{{ route('cadastroUsuarioLogin') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="mb-3 labelQualSeuNome" for="nome">{{ __('Informe seu Nome:') }}</label>
                                <input id="nome" type="name" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" autofocus>
                                @error('nome')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label class="mb-3 labelQualSeuNome" for="nome">{{ __('Defina a sua Senha:') }}</label>
                                <div class="input-group">
                                    <input id="senha" type="password" class="form-control @error('senha') is-invalid @enderror" name="senha" value="{{ old('senha') }}" required autocomplete="senha" autofocus>
                                        <span class="input-group-text toggle-password" id="togglePassword">
                                            <i class="fas fa-lock" id="lock"></i>
                                        </span>
                                </div>                                
                                @error('senha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="mb-3 labelQualSeuNome" for="nome">{{ __('Informe o seu Email:') }}</label>
                                <input id="email" type="name" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary botaoAuthLogin">{{ __('Cadastrar') }}</button>
                            <a href="{{ route('authlogin') }}" class="btn btn-secondary botaoAuthLogin">
                                Voltar para a Página de Login
                            </a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('/js/jquery.min.js') }}"></script>      
        
        <script>
             $(document).ready(function(){
                $('.toggle-password').hover(function(){
                    $(this).css('cursor', 'pointer');
                });
                
                $('.toggle-password').click(function(){
                    const password = $('#senha');
                    const type = password.attr('type') === 'password' ? 'text' : 'password';
                    password.attr('type', type);
                    $(this).find('i').toggleClass('fa-lock fa-lock-open');
                });
            });
        </script>

    </body>
@endsection
