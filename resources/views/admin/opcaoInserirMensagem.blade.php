@extends('layouts.app') 

@section('content')
<body class="fundoAuthLogin">
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card"> 
                <div class="card-header bg-custom">
                    {{ __('Inserir Mensagem Usuário') }}&nbsp;&nbsp;&nbsp;💚
                </div>

                <div class="card-body fundoCard">
                    <form method="POST" action="{{ route('inserirMensagem') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="mb-3 labelQualSeuNome" for="conteudo">{{ __('Conteúdo da Mensagem') }}</label>
                            <input id="conteudo" type="text" class="form-control @error('conteudo') is-invalid @enderror" name="conteudo" value="{{ old('conteudo') }}" required autocomplete="conteudo" autofocus>
                            @error('conteudo')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-3 labelQualSeuNome" for="area">{{ __('Área') }}</label>
                            <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}" required autocomplete="area" autofocus>
                            @error('area')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-3 labelQualSeuNome" for="avaliacao">{{ __('Avaliação') }}</label>
                            <input id="avaliacao" type="text" class="form-control @error('avaliacao') is-invalid @enderror" name="avaliacao" value="{{ old('avaliacao') }}" required autocomplete="avaliacao" autofocus>
                            @error('avaliacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-3 labelQualSeuNome" for="avaliacao">{{ __('Grupo Mensagem') }}</label>
                            <input id="grupoMensagem" type="text" class="form-control @error('grupoMensagem') is-invalid @enderror" name="grupoMensagem" value="{{ old('grupoMensagem') }}" required autocomplete="grupoMensagem" autofocus>
                            @error('grupoMensagem')
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            @enderror
                        </div>
                        
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary botaoAuthLogin">{{ __('Inserir') }}</button>

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
