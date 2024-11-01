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

    'accepted'             => ':attribute должно быть принято.',
    'active_url'           => ':attribute это недопустимый URL-адрес.',
    'after'                => ':attribute должно быть, дата после :date.',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры и тире.',
    "ascii_only"           => ":attribute может содержать только буквы, цифры и тире.",
    'alpha_num'            => ':attribute может содержать только буквы и цифры.',
    'array'                => ':attribute должно быть, это массив.',
    'before'               => ':attribute должно быть, до этого было дата :date.',
    'between'              => [
        'numeric' => ':attribute должно быть, между :min и :max.',
        'file'    => ':attribute должно быть, между :min и :max килобайт.',
        'string'  => ':attribute должно быть, между :min и :max символов.',
        'array'   => ':attribute должно быть, между :min и :max предметов.',
    ],
    'boolean'              => ':attribute поле должно быть true или false.',
    'confirmed'            => ':attribute подтверждение не совпадает.',
    'date'                 => ':attribute это недействительная дата.',
    'date_format'          => ':attribute не соответствует формату :format.',
    'different'            => ':attribute и :other долен быть другим.',
    'digits'               => ':attribute долен быть :digits цифры.',
    'digits_between'       => ':attribute должно быть, между :min и :max цифры.',
    'dimensions'           => ':attribute имеет недопустимые размеры изображения.',
    'distinct'             => ':attribute поле имеет повторяющееся значение.',
    'email'                => ':attribute должен быть действительный адрес электронной почты.',
    'exists'               => 'выбранный :attribute недействителен.',
    'file'                 => ':attribute должно быть, файл.',
    'filled'               => ':attribute поле является обязательным для заполнения.',
    'image'                => ':attribute должно быть,  изображение.',
    'in'                   => 'выбранный :attribute недействителен.',
    'in_array'             => ':attribute поле не существует в :other.',
    'integer'              => ':attribute должно быть целым числом.',
    'ip'                   => ':attribute должен быть действительный IP-адрес.',
    'json'                 => ':attribute должна быть допустимая строка JSON.',
    'max'                  => [
        'numeric' => ':attribute может быть не больше, чем :max.',
        'file'    => ':attribute может быть не больше, чем :max килобайтов.',
        'string'  => ':attribute может быть не больше, чем :max символов.',
        'array'   => ':attribute может иметь не более :max предметов.',
    ],
    'mimes'                => ':attribute должен быть файл с type: :values.',
    'min'                  => [
        'numeric' => ':attribute должно быть, по крайней мере :min.',
        'file'    => ':attribute должно быть, по крайней мере :min килобайтов.',
        'string'  => ':attribute должно быть, по крайней мере :min символов.',
        'array'   => ':attribute должно быть, по крайней мере :min предметов.',
    ],
    'not_in'               => 'выбранный :attribute недействителен.',
    'numeric'              => ':attribute должно быть число.',
    'present'              => ':attribute поле должно присутствовать.',
    'regex'                => ':attribute недопустимый формат.',
    'required'             => ':attribute поле обязательно для заполнения.',
    'required_if'          => ':attribute поле является обязательным, когда :other является :value.',
    'required_unless'      => ':attribute поле является обязательным, если только :other в :values.',
    'required_with'        => ':attribute поле требуется, когда :values присутствует.',
    'required_with_all'    => ':attribute поле требуется, когда :values присутствует.',
    'required_without'     => ':attribute поле требуется, когда :values нет.',
    'required_without_all' => ':attribute поле требуется, когда ни один из :values присутствуют.',
    'same'                 => ':attribute и :other должно соответствовать.',
    'size'                 => [
        'numeric' => ':attribute должно быть :size.',
        'file'    => ':attribute должно быть :size килобайтов.',
        'string'  => ':attribute должно быть :size символов.',
        'array'   => ':attribute должен содержать :size предметов.',
    ],
    'string'               => ':attribute должна быть строка.',
    'timezone'             => ':attribute должна быть допустимая зона.',
    'unique'               => ':attribute уже принят.',
    'url'                  => ':attribute недопустимый формат.',
    "letters"              => "имя пользователя должно содержать хотя бы одну букву или цифру",
    "account_not_confirmed" => "Ваша учетная запись не подтверждена, пожалуйста, проверьте свою электронную почту",
	"user_suspended"        => "Ваша учетная запись была заблокирована, пожалуйста, свяжитесь с нами, если произошла ошибка",

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
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
      'agree_gdpr' => 'поле Я согласен с обработкой персональных данных',
    ],

];
