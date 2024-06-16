<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Foto extends Model
{
    protected $table = 'fotos';

    protected $fillable = [
        'usuario_id',
        'caminho_arquivo',
    ];

    public static function obterCaminhoFotoPerfilUsuario($usuarioId)
    {
        $sql = "SELECT caminho_arquivo
                FROM fotos
                WHERE 
                usuario_id = ?";

        $caminhoFotoPerfilUsuario = DB::select($sql, [$usuarioId]);
        
        if (!empty($caminhoFotoPerfilUsuario)) 
            return $caminhoFotoPerfilUsuario[0]->caminho_arquivo;

        return null;
    }

    public static function inserirNomeECaminhoArquivo($novoCaminhoArquivo, $nomeArquivoSemExtensao, $extensao, $usuarioId)
    {
        $nomeArquivo = $nomeArquivoSemExtensao. $extensao;
        $caminhoArquivo =  $novoCaminhoArquivo;
        
        $sql = "INSERT 
                INTO fotos (nome_arquivo, caminho_arquivo, extensao, usuario_id) 
                VALUES (?, ?, ?, ?)";
    
        DB::insert($sql, [$nomeArquivo, $caminhoArquivo, $extensao, $usuarioId]);
       
    }

    public static function obterNomeArquivo($nomeArquivo, $usuarioId)
    {
        $sql = "SELECT nome_arquivo
                FROM fotos
                WHERE 
                nome_arquivo = ?
                AND usuario_id = ?";
    
        $nomeArquivo = DB::select($sql, [$nomeArquivo, $usuarioId]);
    
        if (!empty($nomeArquivo)) 
            return $nomeArquivo[0]->nome_arquivo;
    
        return null;
    }
    

    public static function atualizaNomeECaminhoArquivo($novoCaminhoArquivo, $novoNomeArquivoSemExtensao, $novaExtensao, $usuarioId)
    {
        $caminhoArquivo = $novoCaminhoArquivo;
        
        $sql = "UPDATE fotos
                SET caminho_arquivo = ?,
                    nome_arquivo = ?,
                    extensao = ?
                WHERE usuario_id = ?";

        DB::update($sql, [$caminhoArquivo, $novoNomeArquivoSemExtensao, $novaExtensao, $usuarioId]);
    }

    
}

