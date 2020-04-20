<?php

namespace Impacto\Lme;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lme extends Model
{
    use SoftDeletes;

    protected $table = 'lme';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data',
        'semana',
        'valor_aluminium',
        'valor_copper',
        'valor_zinc',
        'valor_nickel',
        'valor_lead',
        'valor_tin',
        'valor_aluminium_alloy',
        'valor_nasaac',
        'valor_cobalt',
        'valor_gold',
        'valor_silver',
        'valor_steel_scrap',
        'valor_steel_rebar',
        'valor_dolar'
    ];

    public function getDataAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['data'])->format('d/m/Y');
    }

}
