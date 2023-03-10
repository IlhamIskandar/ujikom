<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('log_class', function (Blueprint $table) {
            $table->id();
            $table->string('process', 50);
            $table->string('old_class_name')->nullable();
            $table->string('new_class_name')->nullable();
            $table->string('old_competency')->nullable();
            $table->string('new_competency')->nullable();
            $table->timestamps();
        });

        DB::unprepared("
            CREATE TRIGGER class_create_trigger AFTER INSERT ON classes 
            FOR EACH ROW
            BEGIN
                INSERT INTO log_class(process, new_class_name, new_competency, created_at, updated_at)
                VALUES('Tambah Data', new.class_name, new.competency, NOW(), NOW());
            END
        ");

        DB::unprepared("
            CREATE TRIGGER class_update_trigger AFTER UPDATE ON classes
            FOR EACH ROW
            BEGIN
                INSERT INTO log_class(process, old_class_name, new_class_name, old_competency, new_competency, created_at, updated_at)
                VALUES('Ubah Data', old.class_name, new.class_name, old.competency, new.competency, NOW(),NOW());
            END
        ");

        DB::unprepared("
            CREATE TRIGGER class_delete_trigger AFTER DELETE ON classes
            FOR EACH ROW
            BEGIN
                INSERT INTO log_class(process, old_class_name, old_competency, created_at, updated_at)
                VALUES('Hapus Data', old.class_name, old.competency, NOW(),NOW());
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
        Schema::dropIfExists('log_class');
        DB::unprepared("DROP TRIGGER IF EXIST 'class_create_trigger'");
        DB::unprepared("DROP TRIGGER IF EXIST 'class_update_trigger'");
        DB::unprepared("DROP TRIGGER IF EXIST 'class_delete_trigger'");
    }
};
