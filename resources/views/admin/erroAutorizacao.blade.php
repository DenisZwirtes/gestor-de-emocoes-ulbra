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
                           {{$erroAutorizacao}}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0" style="margin-left:10%">
        <div class="col-md-6 offset-md-4">
            <a href="{{ route('authlogin') }}" class="btn btn-secondary mt-4 botaoAuthLogin">
                Voltar para a Página de Login
            </a>
        </div>
    </div>

</body>
@endsection
