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

}
