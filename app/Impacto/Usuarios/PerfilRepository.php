<?php

namespace Impacto\Usuarios;

class PerfilRepository
{
    public function listagem($busca = null, $perPage = 20){
        return Perfil::query()
            ->when($busca, function ($query) use ($busca){
                $query->where('perfil', 'LIKE', "%$busca%");
            })
            ->paginate($perPage);
    }

    public function store($input) {
        $perfil = Perfil::query()->create($input);

        $perfil->update(['id_raw' => decrypt($perfil->id)]);

        if(isset($input['permissoes'])){
            foreach($input['permissoes'] as $permissao){
                Permissao::query()->create([
                    'perfil_id' => $perfil->id_raw,
                    'acao_id' => $permissao
                ]);
            }
        }

        return $perfil;
    }

    public function show($id) {
        return Perfil::query()->find(decrypt($id));
    }

    public function update($id, $input) {
        $perfil = Perfil::query()->find(decrypt($id));

        Permissao::query()->where('perfil_id', decrypt($id))->delete();

        if(isset($input['permissoes'])){
            foreach($input['permissoes'] as $permissao){
                Permissao::query()->create([
                   'perfil_id' => $perfil->id_raw,
                   'acao_id' => $permissao
                ]);
            }
        }

        return $perfil->update($input);
    }

    public function delete($id) {
        $perfil = Perfil::query()->find(decrypt($id));
        return $perfil->delete();
    }

    public function data()
    {
        $perfis = Perfil::query()->where('ativo', true)
            ->orderBy('perfil')
            ->get();
        $perfis = $perfis->pluck('perfil', 'id_raw')->toArray();

        return $perfis;
    }

    public function checkPermissao($perfil_id, $rota){
        return Acao::query()
            ->select('usuarios_modulos_acoes.*')
            ->join('usuarios_perfis_permissoes', 'usuarios_modulos_acoes.id', '=', 'usuarios_perfis_permissoes.acao_id')
            ->where('usuarios_perfis_permissoes.perfil_id', $perfil_id)
            ->where('rotas', 'LIKE', "%$rota%")
            ->count();
    }

    public function permissoesRaw($perfil_id){
        return Acao::query()
            ->select('usuarios_modulos_acoes.*')
            ->join('usuarios_perfis_permissoes', 'usuarios_modulos_acoes.id', '=', 'usuarios_perfis_permissoes.acao_id')
            ->where('usuarios_perfis_permissoes.perfil_id', $perfil_id)
            ->get();
    }

}
