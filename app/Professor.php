<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = "professores";

    protected $fillable = [
        'matricula', 'escola_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function escola()
    {
        return $this->belongsTo(Escola::class, 'escola_id', 'id');
    }

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'id_projeto');
    }
}
