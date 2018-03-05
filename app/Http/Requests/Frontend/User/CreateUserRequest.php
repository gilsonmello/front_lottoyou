<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;

class CreateUserRequest extends FormRequest
{
    public function __construct(Factory $factory){
        $factory->extend('greater_than_field', function ($attribute, $value, $parameters){
            return $value > 0;
        });
    }

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
            'name' => 'required|min:3|unique:laravel_users,name|regex:/^([\pL\s\ ]+)$/u',
            'last_name' => 'required|min:3|unique:laravel_users,name|regex:/^([\pL\s\ ]+)$/u',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'birth_day' => 'required',
            'birth_month' => 'required',
            'birth_year' => 'required',
            'country' => 'required',
            //'birth_day' => 'required',
            //'confirm_password' => 'required|min:6|same:password',
            //'birth_date' => 'required',
            //'supplier_id'  => 'required|greater_than_field:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'cpf.min' => 'Informe o CPF com 11 números',
            'email.email' => trans('validation.user.create.email.email'),
            'email.required' => trans('validation.user.create.email.required'),
            'name.required' => trans('validation.user.create.name.required'),
            'name.min' => trans('validation.user.create.name.min'),
            'name.regex' => trans('validation.user.create.name.regex'),
            'name.unique' => trans('validation.user.create.name.unique'),
            'last_name.min' => trans('validation.user.create.last_name.min'),
            'birth_day.required' => trans('validation.user.create.birth_day.required'),
            'birth_month.required' => trans('validation.user.create.birth_month.required'),
            'birth_year.required' => trans('validation.user.create.birth_year.required'),
            'country.required' => trans('validation.user.create.country.required'),
            //'role_id.required' => 'O campo perfil é obrigatório',
            //'confirm_password.required' => 'O campo Confirme a senha é obrigatório',
            //'confirm_password.same' => 'O campo Confirme a senha deverá ser igual a senha',
            //'confirm_password.min' => 'O campo Confirme a senha deverá conter no mínimo 6 caracteres.',
            //'birth_date.required' => 'O campo Data de Nascimento é obrigatório',
            //'supplier_id.required' => 'O campo Academia é Obrigatório',
            //'supplier_id.greater_than_field' => 'O campo Academia é Obrigatório',
        ];
    }
}
