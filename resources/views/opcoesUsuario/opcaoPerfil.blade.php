@extends('layouts.app')

@section('content')
    <body class="cardOpcoes">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center textoGerenciar cardOpcoes">Perfil</div>

                        <div class="card-body fundoCard">
                            <form method="POST" action="{{ route('salvarPerfil') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="nome" class="col-md-4 col-form-label text-md-right">Nome:</label>
                                    <div class="col-md-6">
                                        <input id="nome" type="text" class="form-control" name="nome" value="{{ $nomeUsuario }}" required>
                                    </div>
                                </div>
                            
                                <div class="form-group row mt-4">
                                    <label for="foto" class="col-md-4 col-form-label text-md-right">Foto:</label>
                                    <div class="col-md-6">
                                        <input id="foto" type="file" class="form-control botaoAuthLogin" style="color: rgb(39, 126, 54);" name="fotoPerfil">
                                    </div>
                                </div>
                            
                                <div class="form-group row mb-0 mt-4">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary botaoAuthLogin">Salvar Alterações</button>
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-0" style="margin-right: 80%">
            <div class="col-md-6 offset-md-4">
                <a href="{{ route('loginIndexMensagem') }}" class="btn btn-secondary mt-4 botaoAuthLogin">
                    <i class="fas fa-arrow-left"></i> 
                </a>
            </div>
        </div>

    </body>

    <script src="{{ asset('js/sweetAlert.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#foto').change(function () {
                var arquivo = $(this)[0].files[0];
                var nomeArquivo = arquivo.name;

                var formData = new FormData();

                formData.append('fotoPerfil', arquivo);
                formData.append('nomeArquivo', nomeArquivo);
                formData.append('alterarPerfil', true);

                $.ajax({
                    type: 'POST',
                    url: '/upload-foto-perfil/',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Sua foto de perfil foi atualizada com sucesso!'
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Ocorreu um erro ao atualizar sua foto de perfil. Por favor, tente novamente!'
                        });
                    }
                });
            });
        });
    </script>
@endsection
