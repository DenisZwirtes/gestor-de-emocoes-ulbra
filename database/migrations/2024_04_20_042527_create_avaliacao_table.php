<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $sql = "CREATE TABLE avaliacao (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT UNSIGNED,
            area VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        DB::unprepared($sql);
    }

    public function down()
    {
        DB::unprepared('DROP TABLE IF EXISTS avaliacao');
    }
};

