<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonayValidationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //é para a parte de acl, verifica onde verifica níveis de acesso, se a passoa tem ou não autorização para fazer a transação. 
        return true;   
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|numeric',

        ];
    }
}
