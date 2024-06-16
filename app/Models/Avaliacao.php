<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Avaliacao extends Model
{
    protected $table = 'avaliacao';

    protected $fillable = [
        'usuario_id'
    ];

    public static function obterCodAvaliacao($usuarioId, $area)
    {
        $sql = "SELECT cod_avaliacao
                FROM avaliacao
                WHERE 
                usuario_id = ?
                AND area = ?";

        $avaliacao = DB::select($sql, [$usuarioId, $area]);

        if (!empty($avaliacao)) 
            return $avaliacao[0]->cod_avaliacao;

        return null;
    }

    public static function obterIdAvaliacao($usuarioId, $area)
    {
        $sql = "SELECT id
                FROM avaliacao
                WHERE 
                usuario_id = ?
                AND area = ?";

        $idAvaliacao = DB::select($sql, [$usuarioId, $area]);

        if (!empty($idAvaliacao)) 
            return $idAvaliacao[0]->id;

        return null;
    }


    public static function inserirAvaliacao($usuarioId, $avaliacao, $area)
    {
        $sql = "INSERT 
                INTO avaliacao (usuario_id, cod_avaliacao, area) 
                VALUES (?, ?, ?)";

       DB::insert($sql, [$usuarioId, $avaliacao, $area]);
    }

    public static function atualizarAvaliacaoExistente($novaAvaliacao, $usuarioId, $area)
    {
        $sql = "UPDATE avaliacao
                SET cod_avaliacao = ?
                WHERE usuario_id = ?
                AND area = ?";

        DB::update($sql, [$novaAvaliacao, $usuarioId, $area]);
    }

}

