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
        Schema::create('spp_payments', function (Blueprint $table) {
            $table->id('spp_payment_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->string('nisn', 20)->nullable();
            $table->foreign('nisn')->references('nisn')->on('students')->onUpdate('cascade')->nullOnDelete();
            $table->string('payer', 20)->nullable();
            $table->timestamp('payment_date');
            $table->unsignedbiginteger('spp_id');
            // $table->foreign('spp_id')->references('spp_id')->on('students');
            $table->integer('pay_amount');
            $table->string('code', 15);
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
        Schema::dropIfExists('spp_payments');
    }
};
