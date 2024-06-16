@extends('layouts.app') 

@section('content')
<body class="fundoAuthLogin">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card"> 
                <div class="card-header bg-custom">
                    {{ __('Editar Mensagem Usuário') }}&nbsp;&nbsp;&nbsp;💚
                </div>

                <div class="card-body fundoCard">
                    <form method="POST" action="{{ route('editarMensagem') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="mb-3 labelQualSeuNome" for="conteudo">{{ __('Conteúdo da Mensagem') }}</label>
                            <input id="conteudo" type="text" class="form-control @error('conteudo') is-invalid @enderror" name="conteudo" value="{{ $mensagem[0]->conteudo ?? old('conteudo') }}" required autocomplete="conteudo" autofocus>
                            @error('conteudo')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-3 labelQualSeuNome" for="area">{{ __('Área') }}</label>
                            <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ $mensagem[0]->area ?? old('area') }}" required autocomplete="area" autofocus>
                            @error('area')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-3 labelQualSeuNome" for="avaliacao">{{ __('Avaliação') }}</label>
                            <input id="avaliacao" type="text" class="form-control @error('avaliacao') is-invalid @enderror" name="avaliacao" value="{{ $mensagem[0]->avaliacao ?? old('avaliacao') }}" required autocomplete="avaliacao" autofocus>
                            @error('avaliacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3" style="display: none">
                            <label class="mb-3 labelQualSeuNome" for="avaliacao">{{ __('Grupo Mensagem') }}</label>
                            <input id="grupo_mensagem" type="text" class="form-control @error('grupo_mensagem') is-invalid @enderror" name="grupo_mensagem" value="{{ $mensagem[0]->grupo_mensagem ?? old('avaliacao') }}" required autocomplete="grupo_mensagem" autofocus>
                            @error('grupo_mensagem')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary botaoAuthLogin">{{ __('Atualizar') }}</button>

                            <a style="margin-left: 10px" href="{{ route('opcaoMensagemAdmin') }}" class="btn btn-secondary botaoAuthLogin">
                                Voltar
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div> 
</body>
@endsection
