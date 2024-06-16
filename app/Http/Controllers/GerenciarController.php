<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class GerenciarController extends BaseController
{
    private $usuario;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->usuario = session('usuario');
            return $next($request);
        });
    }

    public function index()
    {
        return view('opcoesUsuario.opcaoGerenciar');
    }

    public function gerenciarArea(Request $request)
    {
        if (!$request->avaliacao)
            return response()->json(['menssagem' => 'É necessário clicar nas estrelas se deseja avaliar', 'redirecionar' => '/gerenciar']);

        $avaliacao = $this->gerenciarAvaliacao($request->avaliacao, $request->area);
        $grupoMensagem = Mensagem::obterGrupoMensagem($avaliacao, $request->area);
        $mensagemExistente = Mensagem::obterGrupoMensagemEConteudoByArea($request->area, $this->usuario->id);
   
        $mensagem = $this->inserirOuAtualizarMensagem($mensagemExistente, $grupoMensagem, $avaliacao, $request);

        return response()->json(['mensagem' => $mensagem[0]['conteudo'], 'redirecionar' => '/gerenciar']);
    }

    private function gerenciarAvaliacao($avaliacao, $area)
    {
        $avaliacaoUsuario = Avaliacao::obterIdAvaliacao($this->usuario->id, $area);
    
         if (!$avaliacaoUsuario) {
            Avaliacao::inserirAvaliacao($this->usuario->id, $avaliacao, $area);
            return Avaliacao::obterCodAvaliacao($this->usuario->id, $area);
        }

        Avaliacao::atualizarAvaliacaoExistente($avaliacao, $this->usuario->id, $area);
        return Avaliacao::obterCodAvaliacao($this->usuario->id, $area);

    }

    private function inserirOuAtualizarMensagem($mensagemExistente, $grupoMensagem, $avaliacao, $request)
    {
        if (!$mensagemExistente) {
            Mensagem::inserirMensagemUsuario($avaliacao, $request->area, $this->usuario->id);
        } else {
            Mensagem::atualizarMensagemUsuario($grupoMensagem, $request->area, $avaliacao, $this->usuario->id);
        }

        return Mensagem::obterGrupoMensagemEConteudoPorUsuario($avaliacao, $request->area, $this->usuario->id);
    }

}
