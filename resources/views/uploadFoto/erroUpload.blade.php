@extends('layouts.app')

@section('content')
<body class="cardOpcoes">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center textoGerenciar cardOpcoes">Erro no Upload</div>

                    <div class="card-body fundoCard">
                        <div class="alert alert-danger">
                            <strong>Erro:</strong> {{$erro}}
                        </div>

                        <p class="mb-0 text-white">
                            Houve um problema durante o upload da imagem. Certifique-se de que a imagem atenda aos requisitos
                            e tente novamente.
                        </p>

                        <p class="mb-0 mt-2 text-white">
                            <strong>Requisitos da Imagem:</strong>
                            <br> - Formatos permitidos: jpeg, png, jpg, gif
                            <br> - Tamanho máximo: 2MB
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0" style="margin-left:10%">
        <div class="col-md-6 offset-md-4">
            <a href="{{ route('loginIndexMensagem') }}" class="btn btn-secondary mt-4 botaoAuthLogin">
                Voltar para a Página de Login
            </a>
        </div>
    </div>

</body>
@endsection
