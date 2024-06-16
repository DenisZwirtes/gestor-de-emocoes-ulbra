<!-- resources/views/gerenciar/index.blade.php -->

@extends('layouts.app')

@section('content')

<style>

    #botaoVoltar {
        margin-right: 80%;
    }

    @media(max-width: 450px) {
        #gerenciarOpcoes {
            position:absolute !important;
            top: 90px !important;
            left: 0px !important;
        }
        #textoClassificar {
            font-size: 16px !important;
        }
        #botaoVoltar {
            margin-right: 0%;
            position:absolute !important;
            top: 5px !important;
            left: 25px !important;
        }
    }

</style>

<div class="container mt-5">
    <body class="fundoPaginaInicial">
        <div id="botaoVoltar" class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <a href="{{ route('loginIndexMensagem') }}" class="btn btn-secondary mt-4 botaoAuthLogin">
                    <i class="fas fa-arrow-left"></i> 
                </a>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="gerenciarOpcoes" class="card cardOpcoes">
                    <div class="card-header text-center textoGerenciar">
                        {{ __('Gerenciar Emoções') }}
                    </div>

                    <div class="card-body fundoCard">
                        <h4 id="textoClassificar">
                            Escolha a área para classificar suas emoções:
                        </h4>

                        <div class="row mt-4">
                            <div class="col-md-4 mb-4">
                                <div class="card cardOpcoes">
                                    <img src="{{ asset('img/geral.png') }}" class="card-img-top" alt="Ícone Geral">
                                    <div class="card-body divCardBodyTamanhosIguais">
                                        <h5 class="card-title textoOpcoes">
                                            Área Geral
                                        </h5>
                                        <p class="card-text textoOpcoes">
                                            Classifique suas emoções gerais aqui.
                                        </p>
                                        <a href="#" class="btn btn-primary botaoAuthLogin classificar-btn tamanhoFonteClassificar" data-toggle="modal" data-target="#classificarModal" data-area="Geral">
                                            Classificar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="card cardOpcoes">
                                    <img src="{{ asset('img/familia.jpeg') }}" class="card-img-top" alt="Ícone Família">
                                    <div class="card-body divCardBodyTamanhosIguais">
                                        <h5 class="card-title textoOpcoes">
                                            Área Família
                                        </h5>
                                        <p class="card-text textoOpcoes">
                                            Classifique suas emoções em relação à família.
                                        </p>
                                        <a href="#" class="btn btn-primary botaoAuthLogin classificar-btn tamanhoFonteClassificar" data-toggle="modal" data-target="#classificarModal" data-area="Família">
                                            Classificar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="card cardOpcoes">
                                    <img src="{{ asset('img/trabalho.png') }}" class="card-img-top" alt="Ícone Trabalho">
                                    <div class="card-body divCardBodyTamanhosIguais">
                                        <h5 class="card-title textoOpcoes">
                                            Área Trabalho
                                        </h5>
                                        <p class="card-text textoOpcoes">
                                            Classifique suas emoções em relação ao trabalho.
                                        </p>
                                        <a href="#" class="btn btn-primary botaoAuthLogin classificar-btn tamanhoFonteClassificar" data-toggle="modal" data-target="#classificarModal" data-area="Trabalho">
                                            Classificar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    <!-- Modal -->
    <div class="modal fade" id="classificarModal" tabindex="-1" role="dialog" aria-labelledby="classificarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content fundoCard">
                <div class="modal-header">
                    <h5 class="modal-title" id="classificarModalLabel">
                        Classificar Emoções
                    </h5>
                    <button style="border-radius: 70px" type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true" class="text-dark">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                </div>
                <div style="font-size: 26px" class="modal-body text-center">
                    <!-- Conteúdo do formulário de classificação aqui -->
                    <span id="star1" class="star" data-value="1">⭐</span>
                    <span id="star2" class="star" data-value="2">⭐</span>
                    <span id="star3" class="star" data-value="3">⭐</span>
                    <span id="star4" class="star" data-value="4">⭐</span>
                    <span id="star5" class="star" data-value="5">⭐</span>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary botaoAuthLogin" id="salvarClassificacao">
                        Salvar Classificação
                    </button>
                    <button type="button" class="btn btn-secondary botaoAuthLogin" data-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fechamento do Modal -->

</div>

<script src="{{ asset('js/sweetAlert.js') }}"></script>

<script>
    function removerAcentos(str) {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    }

    $(document).ready(function() {
        var area;
        var avaliacao; 

        // Função para carregar o conteúdo do modal ao fechar e abrir de novo
        function carregarConteudoModal() {
            $('#classificarModal .modal-body').html(`
                <!-- Conteúdo do formulário de classificação aqui -->
                <span id="star1" class="star" data-value="1">⭐</span>
                <span id="star2" class="star" data-value="2">⭐</span>
                <span id="star3" class="star" data-value="3">⭐</span>
                <span id="star4" class="star" data-value="4">⭐</span>
                <span id="star5" class="star" data-value="5">⭐</span>
            `);

            // Reatribui o evento de clique nas estrelas após carregar o conteúdo
            atribuirEventoEstrelas();
        }

        // Função para atribuir o evento de clique nas estrelas
        function atribuirEventoEstrelas() {
            $('.star').click(function() {
                avaliacao = $(this).data('value');
                area = $(this).data('area');
                
                // Exibir alerta Swal ao invés de alert
                Swal.fire({
                    icon: 'info',
                    title: 'Avaliação selecionada!',
                    text: 'Você avaliou com ' + avaliacao + ' estrela(s). Clique em "Salvar Classificação" para confirmar.',
                });
            });
        }

        // Abre o modal ao clicar no botão "Classificar"
        $('.classificar-btn').click(function() {
            // Obtém a área associada ao botão clicado
            area = $(this).data('area');
            
            // Define a área no modal (você pode personalizar isso conforme necessário)
            $('#classificarModal .modal-title').text('Classificar Emoções - ' + area);
            $('#classificarModal .modal-title').data('value', area); 

            // Carrega o conteúdo do modal
            carregarConteudoModal();
            
            // Abre o modal
            $('#classificarModal').modal('show');
        });

        // Fecha o modal ao clicar no botão Fechar ou no ícone X
        $('#classificarModal .close, #classificarModal .btn-secondary').click(function() {
            // Fecha o modal
            $('#classificarModal').modal('hide');
        });

        // Limpa o conteúdo do modal ao ser totalmente oculto
        $('#classificarModal').on('hidden.bs.modal', function () {
            // Limpar qualquer conteúdo dentro do modal ao fechar
            $(this).find('.modal-body').html('');
        });

        // Armazena a avaliação selecionada ao clicar nas estrelas
        $('.star').click(function() {
            avaliacao = $(this).data('value');
        });

        // Envia a avaliação para o servidor quando clicar no botão Salvar Classificação
        $('#salvarClassificacao').click(function() {
            var valorArea = $('#classificarModal .modal-title').data('value');
            var area = removerAcentos(valorArea.toLowerCase());

            if (!avaliacao) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atenção!',
                    text: 'Por favor, clique nas estrelas para avaliar.',
                });
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/gerenciar-area',
                data: { 
                    avaliacao: avaliacao,
                    area: area
                },
                success: function(response) {
                    if (response.redirecionar) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: response.mensagem, 
                        }).then(() => {
                            window.location.href = response.redirecionar + '?mensagem=' + encodeURIComponent(response.mensagem);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Ocorreu um erro inesperado.',
                        }).then(() => {
                            window.location.href = '#';
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Ocorreu um erro inesperado.',
                    });
                }
            });
        });
    });

</script>

@endsection
