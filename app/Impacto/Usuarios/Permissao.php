<?php

namespace Impacto\Usuarios;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{

    protected $table = 'usuarios_perfis_permissoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'perfil_id',
        'acao_id'
    ];

}
