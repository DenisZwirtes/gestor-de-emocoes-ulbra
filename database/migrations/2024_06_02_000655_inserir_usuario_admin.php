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
        $sqlInser = "INSERT INTO usuarios(nome, email, senha, tipo_usuario)
                     VALUES('Denis', 'zwirtesdenis@gmail.com', '1234', 'admin')";

        DB::unprepared($sqlInser);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
