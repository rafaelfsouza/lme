<?php

namespace Impacto\Usuarios;

class UsuarioRepository
{
    public function listagem($busca = null, $perPage = 20){
        return Usuario::query()
            ->with('perfil')
            ->when($busca, function ($query) use ($busca){
                $query->where(function($query) use ($busca) {
                    $query->where('nome', 'LIKE', "%$busca%")
                        ->orWhere('email', 'LIKE', "%$busca%");
                });
            })
            ->paginate($perPage);
    }

    public function store($input) {
        $input['password'] = bcrypt($input['password']);
        $usuario = Usuario::query()->create($input);

        $usuario->update(['id_raw' => decrypt($usuario->id)]);

        return $usuario;
    }

    public function show($id) {
        return Usuario::query()
            ->find(decrypt($id));
    }

    public function update($id, $input) {
        if (!$input['password']){
            unset($input['password']);
        }else{
            $input['password'] = bcrypt($input['password']);
        }
        $instance = Usuario::query()
            ->find(decrypt($id));
        return $instance->update($input);
    }

    public function delete($id) {
        $instance = Usuario::query()
            ->find(decrypt($id));
        return $instance->delete();
    }

    public function updateSenha($id, $input)
    {
        $input['password'] = bcrypt($input['password']);
        $instance = Usuario::query()->find(decrypt($id));
        return $instance->update($input);
    }

    public function data()
    {
        $usuarios = Usuario::query()->where('ativo', true)->orderBy('nome')->get();
        $usuarios = $usuarios->pluck('nome', 'id_raw')->toArray();

        return $usuarios;
    }

}
