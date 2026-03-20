<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogsExibicao extends Model
{
    protected $table = 'logs_exibicoes';

    protected $fillable = [
        'tipo',
        'referencia_id',
        'inicio',
        'fim',
        'visualizacoes',
    ];

    protected $casts = [
        'inicio' => 'datetime',
        'fim'    => 'datetime',
    ];
}
