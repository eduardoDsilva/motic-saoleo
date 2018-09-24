<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{

    protected $fillable = [
        'tiulo', 'area', 'estande', 'resumo', 'ano', 'tipo', 'notaUm', 'notaDois', 'notaTres', 'notaQuatro', 'notaCinco', 'notaFinal', 'observacoes', 'categoria_id', 'escola_id', 'primeiro_aluno_id', 'segundo_aluno_id', 'terceiro_aluno_id'
    ];

}
