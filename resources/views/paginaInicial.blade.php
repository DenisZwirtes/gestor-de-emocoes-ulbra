<!-- resources/views/paginaInicial.blade.php -->

@extends('layouts.app')

@section('content')

<body class="fundoPaginaInicial">
    
    <div id="menuContainer">
        <i class="fas fa-bars menu-icon" id="menuIcon"></i> <!-- Ícone de menu -->
        <div id="menuOptions">
            <a class="menuOption logout-link" href="{{ route('opcaoPerfil') }}">Perfil</a>
            <a class="menuOption logout-link" href="{{ route('opcaoStatus') }}">Status</a>
            <a class="menuOption logout-link" href="{{ route('opcaoGerenciar') }}">Gerenciar</a>

            @if(isset($tipoUsuario) && $tipoUsuario === 'admin')
            <a class="menuOption logout-link" href="{{ route('opcaoMensagemAdmin') }}">Admin</a>
            @endif
        
            
            <a class="menuOption logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sair
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="profile-picture-container" id="fotoPerfil">
        <img id="avatar" class="avatar" src="{{ isset($caminhoFoto) ? url($caminhoFoto) : \App\Helpers\Constantes::CAMINHO_FOTO_PADRAO }}" alt="Foto do Perfil" class="profile-picture">
        <div id="alterarFoto" class="ocultarAlterarFoto mt-2">
            <a class="logout-link" href="{{ route('mostrarFormulario') }}">Alterar Foto</a>
        </div>

        <div id="sairAvatar" class="ocultarAlterarFoto">
            <a class="menuOption logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sair
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    
    <h1 class="h1PaginaInicial text-center">Gestor De Emoções Do Demander</h1>

    @isset($nomeUsuario)
        <p class="paragrafoPaginaInicial text-center">Seja bem-vindo ao Gestor de Emoções,  <span style="color: #06d183">{{ $nomeUsuario }}</span> &nbsp;😄!</p>
        <h4 class="h3PaginaInicial text-center">{{ isset($mensagem) ? $mensagem : \App\Helpers\Constantes::MENSAGEM_PADRAO }}</p>
            @else
        <p class="paragrafoPaginaInicial">Nome não fornecido.</p>
    @endisset

    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/avatar.js') }}"></script>

</body>

@endsection
