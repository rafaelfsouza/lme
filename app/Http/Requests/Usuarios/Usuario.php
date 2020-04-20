<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class Usuario extends FormRequest
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
        return [
            'perfil_id' => 'required',
            'nome' => 'required',
            'email' => 'required|unique:usuarios,email,' .$this->segment(3) . ',id,deleted_at,NULL',
            'password' => 'required|confirmed'
        ];
    }
}
