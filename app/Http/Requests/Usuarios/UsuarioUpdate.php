<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $usuario = \Impacto\Usuarios\Usuario::query()->where('id', decrypt($this->segment(3)))->first();

        return [
            'perfil_id' => 'required',
            'nome' => 'required',
            'email' => 'required|unique:usuarios,email,' .$usuario->id_raw . ',id,deleted_at,NULL',
            'password' => 'confirmed'
        ];
    }
}
