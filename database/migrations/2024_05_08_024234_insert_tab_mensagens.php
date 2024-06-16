<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    $sqlAddColumn = "ALTER TABLE avaliacao ADD COLUMN cod_avaliacao int";

    $sqlInsert = "INSERT INTO mensagens(conteudo, area, avaliacao, grupo_mensagem)
                  VALUES
                  -- Trabalho
                  ('Você precisa procurar um profissional urgente para avaliar sua situação na área do trabalho', 'trabalho', 1, 1),
                  ('Seu desempenho no trabalho pode ser melhorado. Considere conversar com um colega ou supervisor.', 'trabalho', 2, 2),
                  ('Mantenha o foco e continue buscando a melhoria no trabalho. Você está no caminho certo.', 'trabalho', 3, 3),
                  ('Você está se saindo bem no trabalho. Continue assim!', 'trabalho', 4, 4),
                  ('Parabéns! Continue assim, você está se saindo muito bem no trabalho.', 'trabalho', 5, 5),
                  -- Família
                  ('É importante estabelecer limites e comunicação clara em relação ao trabalho em família.', 'família', 1, 6),
                  ('Encontre um equilíbrio saudável entre trabalho e família. Lembre-se de reservar tempo para seus entes queridos.', 'família', 2, 7),
                  ('Aproveite o tempo com sua família, é essencial para o seu bem-estar emocional.', 'família', 3, 8),
                  ('Mantenha uma boa comunicação e conexão com sua família. Eles são seu maior apoio.', 'família', 4, 9),
                  ('Valorize os momentos em família. Eles são preciosos e fortalecem os laços afetivos.', 'família', 5, 10),
                  -- Geral
                  ('Lembre-se de cuidar de si mesmo e praticar a autorreflexão.', 'geral', 1, 11),
                  ('Cuide da sua saúde física e mental. Você merece se sentir bem.', 'geral', 2, 12),
                  ('Concentre-se em coisas positivas e mantenha uma atitude otimista. O futuro é promissor.', 'geral', 3, 13),
                  ('Celebre suas conquistas e aprenda com seus desafios, o crescimento pessoal é contínuo.', 'geral', 4, 14),
                  ('Continue se esforçando para alcançar seus objetivos. Você está no caminho certo.', 'geral', 5, 15)";

    DB::unprepared($sqlInsert);
    DB::unprepared($sqlAddColumn);
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
