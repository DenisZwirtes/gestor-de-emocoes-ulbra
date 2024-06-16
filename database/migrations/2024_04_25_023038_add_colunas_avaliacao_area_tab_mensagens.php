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
        $sqlAddColumn = "ALTER TABLE mensagens
                        ADD COLUMN avaliacao int,
                        ADD COLUMN area varchar(50)";
        
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
