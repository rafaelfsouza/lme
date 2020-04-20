<?php

namespace Impacto\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acao extends Model
{
    use SoftDeletes;

    protected $table = 'usuarios_modulos_acoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modulo_id',
        'permissao',
        'acao',
        'rotas',
        'ordem'
    ];

}
