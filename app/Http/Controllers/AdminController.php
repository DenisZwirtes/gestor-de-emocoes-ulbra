<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
   
    public function index()
    {
        $mensagens = Mensagem::obterMensagens();

        return view('admin.opcaoMensagemAdmin')->with(['mensagens' => $mensagens]);
    }

    public function editarMensagem(Request $request)
    {
        try {
            Mensagem::atualizarMensagem($request->conteudo, $request->area, $request->avaliacao, $request->grupo_mensagem);
    
            $mensagem = "Mensagem atualizada com sucesso!";
            $sucesso = true;
        } catch (\Exception $e) {
            $sucesso = false;
            $mensagem = "Falha ao atualizar a mensagem. Por favor, tente novamente.";
        }
    
        $mensagens = Mensagem::obterMensagens();
    
        return view('admin.opcaoMensagemAdmin')->with(['mensagens' => $mensagens, 'mensagem' => $mensagem, 'sucesso' => $sucesso]);
    }
    

    public function excluirMensagem($grupoMensagem)
    {
        try {
             if (!$grupoMensagem)
                return;

            Mensagem::deletarGrupoDeMensagens($grupoMensagem);
    
            $mensagemDelete = "Mensagem deletada com sucesso!";
            $sucessoDelete = true;
        } catch (\Exception $e) {
            $sucessoDelete = false;
            $mensagemDelete = "Falha ao deletar a mensagem. Por favor, tente novamente.";
        }
    
        $mensagens = Mensagem::obterMensagens();
    
        return view('admin.opcaoMensagemAdmin')->with(['mensagens' => $mensagens, 'mensagem' => $mensagemDelete, 'sucesso' => $sucessoDelete]);
    }

    public function redirecionarViewEditarMensagem($grupo_mensagem)
    {
        $mensagem = Mensagem::obterMensagem($grupo_mensagem);
        
        return view('admin.opcaoEditarMensagem', ['mensagem' => $mensagem]);
    }

    public function redirecionarViewInserirMensagem()
    {
        return view('admin.opcaoInserirMensagem');
    }

    public function inserirMensagem(Request $request)
    {
        try {
          
            Mensagem::inserirMensagemGeral($request->conteudo, $request->area, $request->avaliacao, $request->grupoMensagem);
   
           $mensagemInserir = "Mensagem inserida com sucesso!";
           $sucessoInserir = true;
       } catch (\Exception $e) {
           $sucessoInserir = false;
           $mensagemInserir = "Falha ao inserir a mensagem. Por favor, tente novamente.";
       }
   
       $mensagens = Mensagem::obterMensagens();
   
       return view('admin.opcaoMensagemAdmin')->with(['mensagens' => $mensagens, 'mensagem' => $mensagemInserir, 'sucesso' => $sucessoInserir]);
    }
    
}
