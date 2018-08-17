<?php

namespace App\Http\Requests\Admin\Escola;

use Illuminate\Foundation\Http\FormRequest;

class EscolaUpdateFormRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'categoria_id'          => 'required',
            'email'                 => 'required|email',
            'telefone'              => 'required|digits_between:8, 16',
            'cep'                   => 'required|digits:8',
            'bairro'                => 'required|string|between:4,100',
            'rua'                   => 'required|string|between:4,100',
            'numero'                => 'required|digits_between:1,5',
            'cidade'                => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'estado'                => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'pais'                  => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'complemento'           => 'sometimes|nullable|alpha_num',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é de preenchimento obrigatório!',
            'name.regex' => 'Insira um nome sem números!',
            'name.between' => 'Insira um nome entre 3 e 100 caracteres!',

            'categoria_id.required' => 'O campo categoria é de preenchimento obrigatório!',

            'email.required' => 'O campo email é de preenchimento obrigatório!',
            'email.email' => 'Insira um e-mail válido!',

            'telefone.required' => 'O campo telefone é de preenchimento obrigatório',
            'telefone.digits_between' => 'Insira um telefone entre 8 e 16 dígitos!',

            'cep.required' => 'O campo CEP é de preenchimento obrigatório',
            'cep.digits' => 'Insira um CEP com 8 dígitos!',

            'bairro.required' => 'O campo bairro é de preenchimento obrigatório!',
            'bairro.between' => 'Insira um bairro que tenha entre 4 e 100 caracteres!',
            'bairro.string' => 'Insira um bairro sem caracteres especiais!',

            'rua.required' => 'O campo rua é de preenchimento obrigatório!',
            'rua.between' => 'Insira uma rua que tenha entre 4 e 100 caracteres!',
            'rua.string' => 'Insira uma rua sem caracteres especiais!',

            'numero.required' => 'O campo número é de preenchimento obrigatório!',
            'numero.digits_between' => 'Insira um número válido!',

            'complemento.alpha_num' => 'Insira um complemento sem caracteres especiais!',

            'cidade.required' => 'O campo cidade é de preenchimento obrigatório!',
            'cidade.regex' => 'Insira uma cidade sem caracteres especiais!',

            'estado.required' => 'O campo estado é de preenchimento obrigatório!',
            'estado.regex' => 'Insira um estado sem caracteres especiais!',

            'pais.required' => 'O campo país é de preenchimento obrigatório!',
            'pais.regex' => 'Insira um país sem caracteres especiais!',
        ];
    }
}

