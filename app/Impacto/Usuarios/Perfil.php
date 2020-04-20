<?php

namespace Impacto\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use SoftDeletes;

    protected $table = 'usuarios_perfis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_raw',
        'perfil',
        'ativo'
    ];

    public function getIdAttribute(){
        return encrypt($this->attributes['id']);
    }

}
