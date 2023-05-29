<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lancamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'valor',
        'tipo_gasto',
        'tipo_lancamento_id',
        'descricao'
    ];
}
