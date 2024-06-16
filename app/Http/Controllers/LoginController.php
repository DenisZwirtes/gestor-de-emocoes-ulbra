<?php

namespace App\Http\Controllers;

use App\Helpers\Constantes;
use App\Models\Foto;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Usuario;

class LoginController extends BaseController
{
    private $usuario;

    public function loginShow()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $usuario = $this->obterUsuario($request->input('email'));
 
        if (!$usuario)
          return view('login.cadastroUsuarioLogin')->with('semCadastro', 'Você ainda não possui cadastro por isso foi direcionado para esta tela!');
    
        $senhaValida = $this->verificarSenha($usuario, $request->input('senha'));
        $nomeUsuarioValido = $this->verificarNomeUsuario($usuario, $request->input('nome'));
    
        if (!$senhaValida || !$nomeUsuarioValido)
            return $this->gerarErroLogin();

        Session::put('usuario', $usuario);
        $this->usuario = session('usuario');

        return $this->redirecionarPaginaInicial($this->usuario);
    }

    public function cadastrarUsuario(Request $request)
    {
        $usuario = $this->obterUsuario($request->input('email'));

        if ($usuario)
            return view("login.erroLogin")->with('erroEmailExistente', 'Já existe um usuário com este email!');
 
        Usuario::inserirUsuario($request->nome, $request->email, $request->senha);
        $usuario = $this->obterUsuario($request->input('email'));

        Session::put('usuario', $usuario);
        $this->usuario = session('usuario');

        return $this->redirecionarPaginaInicial($this->usuario);
    }

    public function linkCadastroUsuario()
    {
        return view('login.cadastroUsuarioLogin');
    }

    public function loginIndexMensagem(Request $request)
    {
        $usuario = session('usuario');
        $mensagem = $request->has('mensagem') ? $request->mensagem: Constantes::MENSAGEM_PADRAO;
        $caminhoFoto = $usuario ? Foto::obterCaminhoFotoPerfilUsuario($usuario->id) : Constantes::CAMINHO_FOTO_PADRAO;

        return view('paginaInicial')->with(['nomeUsuario' => $usuario->nome, 'caminhoFoto' => $caminhoFoto, 'mensagem' => $mensagem, 'tipoUsuario' => $usuario->tipo_usuario]);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('auth-login');
    }

    private function obterUsuario($email)
    {
        return Usuario::obterUsuario($email);
    }

    private function verificarSenha($usuario, $senha)
    {
        if (!$usuario) 
            return false;

        return $usuario->senha === $senha;
    }

    private function verificarNomeUsuario($usuario, $nomeUsuarioRequisicao)
    {
        return $usuario->nome === $nomeUsuarioRequisicao;
    }

    private function gerarErroLogin()
    {
        return view('login.erroLogin')->with('erro', 'Credenciais inválidas.');
    }

    private function redirecionarPaginaInicial($usuario)
    {
        $mensagem = Constantes::MENSAGEM_PADRAO;
        $caminhoFoto = Foto::obterCaminhoFotoPerfilUsuario($usuario->id) ?? Constantes::CAMINHO_FOTO_PADRAO;

        return view('paginaInicial')->with(['nomeUsuario' => $usuario->nome, 'caminhoFoto' => $caminhoFoto, 'mensagem' => $mensagem, 'tipoUsuario' => $usuario->tipo_usuario]);
    }
}
