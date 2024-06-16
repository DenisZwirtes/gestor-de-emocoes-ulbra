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
        $sqlAddColumn = "ALTER TABLE mensagens ADD COLUMN grupo_mensagem int DEFAULT NULL;";

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
