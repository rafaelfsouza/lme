<?php

namespace Impacto\Usuarios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modulo extends Model
{
    use SoftDeletes;

    protected $table = 'usuarios_modulos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modulo',
        'ordem'
    ];

    public function acoes(){
        return $this->hasMany(Acao::class, 'modulo_id', 'id')->orderBy('ordem');
    }

}
