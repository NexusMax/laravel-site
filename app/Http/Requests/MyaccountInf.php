<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class MyaccountInf extends FormRequest
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
            'email' => 'required|email|string|min:2|max:255',
            'name' => 'required|regex:/^[a-zA-Zа-яА-Я\'-]+$/u|string|min:2|max:255',
            'lastname' => 'required|regex:/^[a-zA-Zа-яА-Я\'-]+$/u|string|min:2|max:255',
            'city' => 'required|regex:/^[a-zA-Zа-яА-Я\'-]+$/u|string|min:2|max:255',
        ];
    }


    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
