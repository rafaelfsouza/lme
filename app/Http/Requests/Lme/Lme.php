<?php

namespace App\Http\Requests\Lme;

use Illuminate\Foundation\Http\FormRequest;

class Lme extends FormRequest
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
            'data' => 'required'
        ];
    }
}
