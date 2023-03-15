<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS insert_class;
            CREATE PROCEDURE insert_class (IN class_name VARCHAR(191), IN competency VARCHAR(191), IN created_at TIMESTAMP, IN updated_at TIMESTAMP)
            BEGIN
                INSERT INTO classes (class_name, competency, created_at, updated_at)
                VALUES (class_name, competency, created_at, updated_at);
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
