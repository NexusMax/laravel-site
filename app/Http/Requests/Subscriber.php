<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class Subscriber extends FormRequest
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
            'subscribe.email' => 'required|email|unique:subscriber,email',
//            'subscribe.name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'subscribe.name.required' => 'Необходимо заполнить "Имя"',
            'subscribe.email.unique' => 'Такой Email уже есть',
            'subscribe.email.required' => 'Необходимо заполнить Email',
            'subscribe.email.email' => 'Неправильный Email',
            'required' => 'Необходимо заполнить :attribute',
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}
