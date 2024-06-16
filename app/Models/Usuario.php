<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{

    protected $table = 'usuarios';
    
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    /**
     * Obtém um usuário pelo nome e email.
     *
     * @param string $nome
     * @param string $email
     * @return Usuario|null
     */
    public static function obterUsuario($email)
    {
        $sql = "SELECT * 
                FROM usuarios 
                WHERE email = ?";
    
        $usuario = DB::select($sql, [$email]);
        
        if (!empty($usuario)) 
            return $usuario[0];
     
        return null;
        
    }

    public static function obterNomeUsuario($usuarioId)
    {
        $sql = "SELECT nome
                FROM usuarios 
                WHERE id = ?";
    
        $usuario = DB::select($sql, [$usuarioId]);
        
        if (!empty($usuario)) 
            return $usuario[0]->nome;
     
        return null;
        
    }
    

    public static function inserirUsuario($nome, $email, $senha)
    {
        $sql = "INSERT 
                INTO usuarios (nome, email, senha) 
                VALUES (?, ?, ?)";
        
        DB::insert($sql, [$nome, $email, $senha]);
    }

    public static function atualizaNomeUsuario($novoNomeUsuario, $nomeAtualUsuario, $usuarioId)
    {
        $sql = "UPDATE usuarios
                SET nome = ?
                WHERE nome = ?
                AND id = ?";

        DB::update($sql, [$novoNomeUsuario, $nomeAtualUsuario, $usuarioId]);
    }

    public static function deletarUsuario($email)
    {
        $sql = "DELETE 
                FROM usuarios
                WHERE email = ?";

        DB::delete($sql, [$email]);
    }
    
}

