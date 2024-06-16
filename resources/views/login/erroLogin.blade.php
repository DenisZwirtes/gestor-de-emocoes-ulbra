@extends('layouts.app')

@section('content')
<body class="cardOpcoes">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center textoGerenciar cardOpcoes">Erro nas Credenciais</div>

                    <div class="card-body fundoCard">
                        <div class="alert alert-danger">
                            <strong>Erro:</strong> 
                            
                            @isset ($erro)
                            {{$erro}}
                            @endisset

                            @isset ($erroEmailExistente)
                            {{$erroEmailExistente}}
                            @endisset
                        </div>

                        <p class="mb-0 text-white">
                            Por favor, tente novamente!
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group col-lg-12 text-center row mb-0">
        <div>
            <a href="{{ route('authlogin') }}" class="btn btn-secondary mt-4 botaoAuthLogin" style="margin-right:10px">
                Voltar para a Página de Login
            </a>

            <a href="{{ route('linkCadastroUsuario') }}" class="btn btn-secondary mt-4 botaoAuthLogin">
                Ir para a Página de Cadastro
            </a>
        </div>
    </div>

</body>
@endsection
