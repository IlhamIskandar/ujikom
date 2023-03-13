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
        Schema::create('students', function (Blueprint $table) {
            $table->string('nisn', 20);
            $table->primary('nisn');
            $table->string('nis',20)->unique();
            $table->string('student_name');
            $table->foreignId('class_id')->constrained('classes', 'class_id')->default(0);
            $table->text('address');
            $table->string('phone_number', 20);
            $table->foreignId('spp_id')->constrained('spps', 'spp_id');//->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onUpdate('cascade')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
