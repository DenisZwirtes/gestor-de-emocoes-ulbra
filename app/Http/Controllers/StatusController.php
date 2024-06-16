<?php

namespace App\Http\Controllers;

use App\Helpers\Constantes;
use App\Models\Avaliacao;
use App\Models\Mensagem;
use Illuminate\Http\Request; 
use Illuminate\Routing\Controller as BaseController;

class StatusController extends BaseController
{
  
    public function getStatus(Request $request)
    {
        $area = $request->input('area');
        $usuario = session('usuario');
        $codAvaliacao = Avaliacao::obterCodAvaliacao($usuario->id, $area);
        $mensagem = $this->obterMensagem($codAvaliacao, $area);
        $classe = $this->obterClasseBootstrap($codAvaliacao, $area);
        $areaSelecionada = $area ?? null;
        
        return view('opcoesUsuario.opcaoStatus')->with(['mensagem' => $mensagem, 'classe' => $classe, 'areaSelecionada' => $areaSelecionada]);
    }

    public function obterClasseBootstrap($avaliacao, $area)
    {
        if (!$avaliacao && $area)
            return 'danger';

        return match ($avaliacao) {
            1, 2 => 'danger',
            3, 4 => 'warning',
            5 => 'success', 
            default => 'secondary',
        };
    }

    public function obterMensagem($avaliacao, $area)
    {
        if (!$avaliacao && $area)
            return Constantes::MENSAGEM_SEM_AVALIACAO;

        $arrayGrupoMensagemEConteudo = Mensagem::obterGrupoMensagemEConteudoPorUsuario($avaliacao, $area, session('usuario')->id);
        
        return $arrayGrupoMensagemEConteudo[0]['conteudo'] ?? Constantes::MENSAGEM_STATUS;
    }
    
}

