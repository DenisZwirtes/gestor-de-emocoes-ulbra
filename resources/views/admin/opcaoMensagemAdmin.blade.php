@extends('layouts.app')

@section('content')
<body class="cardOpcoes">

    <button type="button" class="btn btn-sm btn-success mt-4" style="margin-left:93%" onclick="redirecionarParaViewInserirMensagem()">
        <i class="fas fa-plus"></i> Novo
    </button>
    
    
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            @if(isset($mensagem))
                <div id="mensagemAlerta" class="alert alert-{{ $sucesso ? 'success' : 'danger' }} text-center" role="alert">
                    {{ $mensagem }}
                </div>
            @endif
        </div>
    </div>
    

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center textoGerenciar cardOpcoes">Mensagens:</div>

                    <div class="card-body fundoCard">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ações</th>
                                        <th>Conteúdo</th>
                                        <th>Área</th>
                                        <th>Avaliação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mensagens as $mensagem)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Ações">
                                                {{-- Vou ter que redirecionar a parte de editar para uma view opcaoEditarMensagem--}}
                                                <!-- Ícone de edição -->
                                                <a style="margin-right: 5px" href="{{ route('viewEditarMensagem', ['grupo_mensagem' => $mensagem->grupo_mensagem]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <!-- Ícone de exclusão -->
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmarExclusao({{ $mensagem->grupo_mensagem }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>{{ $mensagem->conteudo }}</td>
                                        <td>{{ $mensagem->area }}</td>
                                        <td>{{ $mensagem->avaliacao }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mb-2" style="margin-left:10%">
        <div class="col-md-6 offset-md-4">
            <a href="{{ route('loginIndexMensagem') }}" class="btn btn-secondary mt-4 botaoAuthLogin">
                Voltar para a Página Inicial
            </a>
        </div>
    </div>

</body>

</style>

<script src="{{ asset('js/sweetAlert.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>

function redirecionarParaViewInserirMensagem() {
        window.location.href = "{{ route('viewInserirMensagem') }}";
    }

     $(document).ready(function() {
        var mensagemDiv = $('#mensagemAlerta');
        
        if (mensagemDiv.length) {
            mensagemDiv.show();
            
            setTimeout(function() {
                mensagemDiv.fadeOut(1000);
            }, 1500); 
        }
    });

    function confirmarExclusao(grupoMensagem) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, exclua!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('excluirMensagem') }}/" + grupoMensagem;
            }
        });
    }
</script>

@endsection
