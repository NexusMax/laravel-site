<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => ':attribute не совпадают.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ':attribute неверно введен.',
    'exists'               => ':attribute уже существует.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ':attribute не должен превышать :max символов.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => ':attribute не должен превышать :max символов.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute должен содержать минимум :min символов.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute должен содержать минимум :min символов.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => '":attribute" введено неверно.',
    'required'             => ':attribute необходимо заполнить.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => ':attribute должен быть строкой.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ':attribute уже существует.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'name' => [
            'required' => 'Необходимо заполнить "Имя".',
            'max' => 'Имя не должно превышать :max символов.',
            'min' => 'Имя должно содержать минимум :min символов.',
            'regex' => 'Значение "Имя" введено неверно.',
        ],
        'lastname' => [
            'required' => 'Необходимо заполнить "Фамилию".',
            'max' => 'Фамилия не должна превышать :max символов.',
            'min' => 'Фамилия должна содержать минимум :min символов.',
            'regex' => 'Значение "Фамилия" введено неверно.',
        ],
        'email' => [
            'required' => 'Необходимо заполнить "Email".',
            'unique' => 'Такой Email уже зарегистрирован.',
            'exists' => 'Такой Email не зарегистрирован.',
            'max' => 'Email не должен превышать :max символов.',
            'min' => 'Email должен содержать минимум :min символов.',
        ],
        'password' => [
            'required' => 'Необходимо заполнить пароль.',
            'max' => 'Пароль не должен превышать :max символов.',
            'min' => 'Пароль должен содержать минимум :min символов.',
            'confirmed' => 'Пароли не совпадают.',
        ],
        'phone' => [
            'regex' => 'Неверно введет телефон.'
        ],
        'country' => [
            'required' => 'Необходимо заполнить страну.',
            'max' => 'Название страны не должен превышать :max символов.',
            'min' => 'Название страны должен содержать минимум :min символов.',
        ],
        'city' => [
            'required' => 'Необходимо заполнить город.',
            'max' => 'Название города не должно превышать :max символов.',
            'min' => 'Название города должно содержать минимум :min символов.',
            'regex' => 'Значение "Город" введено неверно.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

    ],

];
