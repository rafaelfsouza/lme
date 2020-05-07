<?php

namespace Impacto\Lme;

use Carbon\Carbon;

class LmeRepository
{
    public function listagem($perPage = 20){
        return Lme::query()
            ->orderBy('data', 'desc')
            ->paginate($perPage);
    }

    public function store($input) {

        $data = Carbon::createFromFormat('d/m/Y', $input['data']);
        $input['data'] = $data->format('Y-m-d');
        $input['semana'] = $data->format('W');

        $lme = Lme::query()->where('data', $input['data'])->count();
        if(!$lme) {
            $lme = Lme::query()->create($input);
        }
        return $lme;
    }

    public function show($id) {
        return Lme::query()->find($id);
    }

    public function mes($mes){
        switch ($mes){
            case 'Jan': return 'Jan'; break;
            case 'Fev': return 'Feb'; break;
            case 'Mar': return 'Mar'; break;
            case 'Abr': return 'Apr'; break;
            case 'Mai': return 'May'; break;
            case 'Jun': return 'Jun'; break;
            case 'Jul': return 'Jul'; break;
            case 'Ago': return 'Aug'; break;
            case 'Set': return 'Sep'; break;
            case 'Out': return 'Oct'; break;
            case 'Nov': return 'Nov'; break;
            case 'Dez': return 'Dec'; break;
            default: return 0;
        }
    }

    public function showByDate($date) {

        $data = explode('/', $date);

        if(isset($data[1])) {
            $mes = $this->mes($data[1]);
            if($mes) {
                $data2 = date('Y') . '-' . $mes . '-' . $data[0];

                $dia = Carbon::createFromFormat('Y-M-d', $data2);

                if ($dia) {
                    return Lme::query()->where('data', $dia->format('Y-m-d'))->first();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function update($id, $input) {

        $data = Carbon::createFromFormat('d/m/Y', $input['data']);
        $input['data'] = $data->format('Y-m-d');
        $input['semana'] = $data->format('W');

        $lme = Lme::query()->find($id);
        return $lme->update($input);
    }

    public function delete($id) {
        $lme = Lme::query()->find($id);
        return $lme->delete();
    }

    public function indicadoresMetal($metal, $mes, $ano){

        $inicio = $ano.'-'.$mes.'-01';
        $termino = date($ano.'-'.$mes.'-t');

        return Lme::query()
            ->selectRaw("data, $metal as valor")
            ->whereBetween('data', [$inicio, $termino])
            ->orderBy('data', 'asc')
            ->get();
    }

    public function indicadores($mes, $ano){

        $inicio = $ano.'-'.$mes.'-01';
        $termino = date($ano.'-'.$mes.'-t');

        return Lme::query()
            ->whereBetween('data', [$inicio, $termino])
            ->orderBy('data', 'desc')
            ->get();
    }

}
