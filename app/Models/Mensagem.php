<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mensagem extends Model
{
    protected $table = 'mensagens';

    public static function obterMensagemInicialUsuario($usuarioId)
    {
        $sql = "SELECT conteudo
                FROM mensagens
                WHERE usuario_id = ?";

        $mensagens = DB::select($sql, [$usuarioId]);

        if (!empty($mensagens)) 
            return $mensagens[0]->conteudo;

        return null;
    }

    public static function obterMensagens()
    {
        $sql = "SELECT grupo_mensagem, conteudo, area, avaliacao
                FROM mensagens
                GROUP BY grupo_mensagem, conteudo, area, avaliacao";
        

        $mensagens = DB::select($sql);

         if (!empty($mensagens)) 
            return $mensagens;

        return null;
    }

    public static function obterMensagem($grupoMensagem)
    {
        $sql = "SELECT conteudo, area, avaliacao, grupo_mensagem
                FROM mensagens
                WHERE grupo_mensagem = ?";
        

        $mensagem = DB::select($sql, [$grupoMensagem]);

         if (!empty($mensagem)) 
            return $mensagem;

        return null;
    }

    public static function inserirMensagemUsuario($avaliacao, $area, $usuarioId)
    {
        $arrayGrupoMensagemEConteudo = Mensagem::obterGrupoMensagemEConteudo($avaliacao, $area);
       
       $sql = "INSERT 
                INTO mensagens (avaliacao, area, grupo_mensagem, conteudo, usuario_id) 
                VALUES (?, ?, ?, ?, ?)";

        DB::insert($sql, [$avaliacao, $area, $arrayGrupoMensagemEConteudo[0]['grupo_mensagem'], $arrayGrupoMensagemEConteudo[0]['conteudo'],  $usuarioId]);
    }

    public static function inserirMensagemGeral($conteudo, $area, $avaliacao, $grupoMensagem)
    {
       $sql = "INSERT 
                INTO mensagens (conteudo, area, avaliacao, grupo_mensagem) 
                VALUES (?, ?, ?, ?)";

        DB::insert($sql, [$conteudo, $area, $avaliacao, $grupoMensagem]);
    }

    public static function atualizarMensagem($mensagem, $area, $avaliacao, $grupoMensagem)
    {
        $sql = "UPDATE mensagens
                SET conteudo = ?,
                    area = ?,
                    avaliacao = ?
                WHERE grupo_mensagem  = ?";

        DB::update($sql, [$mensagem, $area, $avaliacao, $grupoMensagem]);
    }

    public static function deletarGrupoDeMensagens($grupoMensagem)
    {
        $sql = "DELETE 
                FROM mensagens
                WHERE grupo_mensagem = ?";

        DB::delete($sql, [$grupoMensagem]);
    }

    public static function obterGrupoMensagemEConteudo($avaliacao, $area) 
    {
        $sql = "SELECT conteudo, grupo_mensagem
                FROM mensagens
                WHERE avaliacao = ? 
                AND area = ?
                GROUP BY conteudo, grupo_mensagem";
    
        $mensagens = DB::select($sql, [$avaliacao, $area]);
    
        if (!empty($mensagens)) {
            $resultado = [];
            foreach ($mensagens as $mensagem) {
                $resultado[] = [
                    'conteudo' => $mensagem->conteudo,
                    'grupo_mensagem' => $mensagem->grupo_mensagem
                ];
            }
            return $resultado;
        }
    
        return null;
    }

    public static function obterGrupoMensagemEConteudoPorUsuario($avaliacao, $area, $usuarioId) 
    {
        $sql = "SELECT conteudo, grupo_mensagem
                FROM mensagens
                WHERE avaliacao = ? 
                AND area = ?
                AND usuario_id = ?
                GROUP BY conteudo, grupo_mensagem";
    
        $mensagens = DB::select($sql, [$avaliacao, $area, $usuarioId]);
    
        if (!empty($mensagens)) {
            $resultado = [];
            foreach ($mensagens as $mensagem) {
                $resultado[] = [
                    'conteudo' => $mensagem->conteudo,
                    'grupo_mensagem' => $mensagem->grupo_mensagem
                ];
            }
            return $resultado;
        }
    
        return null;
    }

    public static function obterGrupoMensagem($avaliacao, $area) 
    {
        $sql = "SELECT grupo_mensagem
                FROM mensagens
                WHERE avaliacao = ? 
                AND area = ?
                GROUP BY grupo_mensagem";
    
        $mensagens = DB::select($sql, [$avaliacao, $area]);
    
        if (!empty($mensagens)) {
            $resultado = [];
            foreach ($mensagens as $mensagem) {
                $resultado[] = [
                    'grupo_mensagem' => $mensagem->grupo_mensagem
                ];
            }
            return $resultado[0]['grupo_mensagem'];
        }
    
        return null;
    }


    public static function obterGrupoMensagemEConteudoByArea($area, $usuarioId) 
    {
        $sql = "SELECT conteudo, grupo_mensagem
                FROM mensagens
                WHERE area = ?
                AND usuario_id = ?
                GROUP BY conteudo, grupo_mensagem";
    
        $mensagens = DB::select($sql, [$area, $usuarioId]);
    
        if (!empty($mensagens)) {
            $resultado = [];
            foreach ($mensagens as $mensagem) {
                $resultado[] = [
                    'conteudo' => $mensagem->conteudo,
                    'grupo_mensagem' => $mensagem->grupo_mensagem
                ];
            }
            return $resultado;
        }
    
        return null;
    }

    public static function atualizarMensagemUsuario($grupoMensagem, $area, $avaliacao, $usuarioId)
    {
        $mensagem = self::obterMensagem($grupoMensagem)[0]->conteudo;

        $sql = "UPDATE mensagens
                SET conteudo = ?,
                    grupo_mensagem = ?,
                    avaliacao = ?
                WHERE usuario_id = ?
                AND  area = ?";

        DB::update($sql, [$mensagem, $grupoMensagem, $avaliacao, $usuarioId, $area]);
    }
    
}
