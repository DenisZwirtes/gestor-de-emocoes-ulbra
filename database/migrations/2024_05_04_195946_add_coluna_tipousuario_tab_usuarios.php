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
        $sqlAddColumn = "ALTER TABLE usuarios ADD COLUMN tipo_usuario varchar(50) DEFAULT 'normal';";

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
