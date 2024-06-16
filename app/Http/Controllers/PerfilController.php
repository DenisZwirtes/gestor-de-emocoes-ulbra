<?php

namespace App\Http\Controllers;

use App\Helpers\Constantes;
use App\Models\Foto;
use App\Models\Mensagem;
use App\Models\Usuario;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Exception;

class PerfilController extends BaseController
{
    /**
     * Obtém o usuário da sessão.
     *
     * @return Usuario|null
     */
    private function obterUsuario()
    {
        return session('usuario');
    }

    public function index(Request $request)
    {
        $usuario = $this->obterUsuario();
        $nomeUsuario = $this->obterNomeUsuario($usuario);
        $caminhoFoto = FotoController::obterCaminhoFoto($request, $usuario->id);

        return view('opcoesUsuario.opcaoPerfil', compact('nomeUsuario', 'caminhoFoto'));
    }

    public function salvarPerfil(Request $request)
    {
        try {
            FotoController::validarRequisicao($request);

            $usuario = $this->obterUsuario();
            $mensagem = Mensagem::obterMensagemInicialUsuario($usuario->id) ?? Constantes::MENSAGEM_PADRAO;
            $nomeUsuario = $this->atualizarNomeUsuario($request, $usuario);
            $caminhoFotoPerfil = FotoController::obterCaminhoFoto($request, $usuario->id);

            return view('paginaInicial')->with(['nomeUsuario' => $nomeUsuario, 'caminhoFoto' => $caminhoFotoPerfil, 'mensagem' => $mensagem]);
        } catch (Exception $excecao) {
            return view('uploadFoto.erroUpload')->with(['erro' => $excecao->getMessage()]);
        }
    }

    private function obterNomeUsuario($usuario)
    {
        $nomeUsuario = Usuario::obterNomeUsuario($usuario->id);

        if (!$nomeUsuario) {
            $nomeUsuario = $usuario->nome;
            Usuario::inserirNomeUsuario($usuario->id, $nomeUsuario);
        }

        return $nomeUsuario;
    }


    private function atualizarNomeUsuario(Request $request, $usuario)
    {
        $novoNomeUsuario = $request->input('nome');
        $nomeAtualUsuario = $this->obterNomeUsuario($usuario);

        if (!$novoNomeUsuario || $novoNomeUsuario === $nomeAtualUsuario)
            return $nomeAtualUsuario;

        Usuario::atualizaNomeUsuario($novoNomeUsuario, $nomeAtualUsuario, $usuario->id);

        return Usuario::obterNomeUsuario($usuario->id);
    }
}
