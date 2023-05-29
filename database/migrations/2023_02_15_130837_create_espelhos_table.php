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
        Schema::create('espelhos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('morador_id')->constrained();
            $table->boolean('status');
            $table->integer('numero_boleto');
            $table->decimal('valor_condominio');
            $table->decimal('valor_fundo_reserva');
            $table->decimal('valor_total');
            $table->decimal('valor_gas');
            $table->decimal('valor_agua');
            $table->decimal('valor_lixo');
            $table->decimal('valor_multa')->nullable();
            $table->decimal('valor_juros')->nullable();
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
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
        Schema::dropIfExists('espelhos');
    }
};
