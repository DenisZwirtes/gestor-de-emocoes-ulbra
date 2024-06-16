<?php

namespace App\Http\Controllers;

use App\Helpers\Constantes;
use App\Models\Foto;
use App\Models\Mensagem;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class FotoController extends BaseController
{
    public function mostrarFormulario()
    {
        return view('uploadFoto.formularioUploadFoto');
    }

    public function uploadFoto(Request $request)
    {
        try {
            self::validarRequisicao($request);

            $usuario = session('usuario');
            $nomeUsuario = $request->nome ? $request->nome : $usuario->nome;
            $usuarioId = $usuario->id;

            $mensagem = Mensagem::obterMensagemInicialUsuario($usuarioId) ?? Constantes::MENSAGEM_PADRAO;
            $caminhoFoto = self::obterCaminhoFoto($request, $usuarioId);

            if ($request->input('alterarPerfil')) {
                return view('opcoesUsuario.opcaoPerfil')->with(['nomeUsuario' => $nomeUsuario, 'caminhoFoto' => $caminhoFoto]);
            }

            return view('paginaInicial')->with(['nomeUsuario' => $nomeUsuario, 'caminhoFoto' => $caminhoFoto, 'mensagem' => $mensagem, 'tipoUsuario' => $usuario->tipo_usuario]);
        } catch (\Throwable $excecao) {
            return view('uploadFoto.erroUpload')->with(['erro' => $excecao->getMessage()]);
        }
    }

    public static function validarRequisicao($request)
    {
        if (!$request->fotoPerfil)
            return;

        $request->validate([
            'fotoPerfil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    public static function obterCaminhoFoto($request, $usuarioId)
    {
        $fotoAtual = Foto::obterCaminhoFotoPerfilUsuario($usuarioId);
        $caminhoPadrao = Constantes::CAMINHO_FOTO_PADRAO;

        if (!$request->hasFile('fotoPerfil') && !$fotoAtual)
            return $caminhoPadrao;

        $novoArquivo = $request->file('fotoPerfil');

        if (!$novoArquivo)
            return $fotoAtual ?: $caminhoPadrao;

        if ($fotoAtual && (isset($fotoAtual->public_id) && $fotoAtual->public_id)) {
            Cloudinary::destroy($fotoAtual->public_id);
        }

        $nomeOriginal = $novoArquivo->getClientOriginalName();

        // Upload para o Cloudinary
        $resultadoUpload = Cloudinary::upload($novoArquivo->getRealPath(), [
            'public_id' => "userId{$usuarioId}-{$nomeOriginal}",
            'folder' => 'fotos_perfil'
        ]);

        $novoCaminho = $resultadoUpload->getSecurePath();
        $publicId = $resultadoUpload->getPublicId();

        if (!$nomeOriginal && !$fotoAtual)
            return $caminhoPadrao;

        $arrayFoto = self::obterNomeEExtensao($nomeOriginal);

        if (!$fotoAtual) {
            Foto::inserirNomeECaminhoArquivo($novoCaminho, $arrayFoto['nomeSemExtensao'], $arrayFoto['extensao'], $usuarioId, $publicId);
        } else {
            Foto::atualizaNomeECaminhoArquivo($novoCaminho, $arrayFoto['nomeSemExtensao'], $arrayFoto['extensao'], $usuarioId, $publicId);
        }

        return Foto::obterCaminhoFotoPerfilUsuario($usuarioId);
    }

    public static function obterNomeEExtensao($nomeArquivo)
    {
        $arrayArquivo = [];
        $nomeArquivoPartes = explode('.', $nomeArquivo);
        $arrayArquivo['nomeSemExtensao'] = $nomeArquivoPartes[0];
        $arrayArquivo['extensao'] = end($nomeArquivoPartes);
        return $arrayArquivo;
    }
}

