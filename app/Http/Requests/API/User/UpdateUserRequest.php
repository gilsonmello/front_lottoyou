<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;

class UpdateUserRequest extends FormRequest
{
    public function __construct() 
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters) 
        {
            $user = User::find($parameters[0]);
            return $user && Hash::check($value, $user->laravel_password);
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
        $rules = [
            //'username' => 'required|email|unique:users,username,'.$this->id.',id',
            'photo' => isset($this->photo) ? 'required|image|mimes:jpg,jpeg,png,gif' : '',
        ];
        
        if(!empty($this->old_password) || !empty($this->password)) {
            $rules['old_password'] = 'required|current_password:'.$this->id;
            $rules['password'] = 'required|min:6';
            $rules['confirm_password'] = 'required|min:6|same:password';
        }

        $rules['birth_date'] = 'required';
        $rules['gender'] = 'required';

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [

        ];
        
        if(!empty($this->old_password)) {
            $messages['old_password.required'] = 'Informe a senha antiga';
            $messages['old_password.current_password'] = 'Senha Inválida';
            $messages['password.required'] = 'Informe a senha';
            $messages['password.min'] = 'No mínimo 6 cáractes';
            $messages['confirm_password.same'] = 'Campo deve ser igual a senha informada';
            $messages['confirm_password.required'] = 'Informe a senha';
            $messages['confirm_password.min'] = 'No mínimo 6 cáractes';
        }

        $messages['gender.birth_date'] = 'Campo obrigatório';
        $messages['gender.required'] = 'Campo obrigatório';

        return $messages;        
    }
}
