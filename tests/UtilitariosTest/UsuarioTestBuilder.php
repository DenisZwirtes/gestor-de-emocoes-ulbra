<?php

namespace Tests\UtilitariosTest;

use App\Models\Usuario;
use Illuminate\Support\Str;

class UsuarioTestBuilder
{
    private $usuario;

    public function __construct($email = null)
    {
       $this->usuario = null;

        if($email)
            $this->usuario = TestableUsuario::obterUsuario($email);
        else
            $email = 'teste' . Str::random(5) . '@exemplo.com';
        
        if (!$this->usuario){
            $this->usuario = new TestableUsuario();
            $this->usuario->nome = 'Usuário Teste';
            $this->usuario->email = $email;
            $this->usuario->senha = bcrypt('senha123');
            $this->usuario->tipo_usuario = 'normal';
        }
        
    }
    

    public function comNome($nome)
    {
        $this->usuario->nome = $nome;
        return $this;
    }

    public function comEmail($email)
    {
        $this->usuario->email = $email;
        return $this;
    }

    public function comSenha($senha)
    {
        $this->usuario->senha = bcrypt($senha);
        return $this;
    }

    public function comTipoUsuario($tipo_usuario)
    {
        $this->usuario->tipo_usuario = $tipo_usuario;
        return $this;
    }

    public function salvar()
    {
        $this->usuario->save();
        return $this->usuario;
    }

    public function excluir()
    {
        TestableUsuario::deletarUsuario($this->usuario->email);
    }
}
