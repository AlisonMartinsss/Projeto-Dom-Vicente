<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espelho extends Model
{
    use HasFactory;

    protected $fillable = [
        'morador_id',
        'numero_boleto',
        'valor_condominio',
        'valor_fundo_reserva',
        'valor_total',
        'valor_gas',
        'valor_agua',
        'valor_lixo',
        'valor_multa',
        'valor_juros',
        'status',
        'data_vencimento',
        'data_pagamento'
    ];

    public function morador(){
        return $this->belongsTo('App\Models\Morador');
    }
}
