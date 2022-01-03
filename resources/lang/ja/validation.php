<?php

return [
    'required' => ':nameを入力してください。',
    'max' => ':nameは:max文字以内で入力してください。',
    'min' => ':nameは:min文字以上で入力してください。',
    'email' => '正しいメールアドレス形式で入力してください。(例 abc@example.com)',
    'integer' => ':nameは半角数字で入力して下さい。',
    'digits' => ':nameは:digits桁で入力してください。',
    'digits_between' => ':nameは:min桁以上:max桁以内の半角数字で入力してください。',
    'boolean' => ':nameが不正です。',
    'choice' => [
        'required' => ':nameを選択してください。',
        'integer' => ':nameが不正です。',
        'in' => ':nameが不正です。',
        'not_in' => ':nameが不正です。',
        'array' => ':nameが不正です。',
        'between' => ':nameが不正です。',
        'min' => ':nameが不正です。',
        'date_format' => ':nameが不正です。',
        'required_without_all' => 'いずれかの:nameを選択してください。',
        'distinct' => ':nameが重複しています。',
        'different' => '他の:nameを選択してください。',
    ],
    'gt' => [
        'numeric' => ' :nameは:valueよりも大きい数字で入力してください。',
    ],
    'file' => [
        'max' => ':nameは:size以下のファイルを選択してください。',
        'mimes' => ':nameは正しい形式のファイルを選択してください。',
    ],
    'csv' => [
        'columns_count' => 'カラム数が一致しません',
    ],
    'required_create' => ':nameを作成してください。',
    'date_format' => ':nameが不正です。',
    'before_or_equal' => ':nameは:target以前の値で入力してください。',
    'after_or_equal' => ':nameは:target以後の値で入力してください。',
    'same' => ':nameと:name(確認用)は同じ値を入力してください。',
    'regex' => ':nameが不正です。',
    'not_in' => ':nameが不正です。',
    'gte' => ':nameは:target以上の値で入力してください。',
    'lte' => ':nameは:target以下の値で入力してください。',
    'array' => ':nameが不正です。',

    /*
     |--------------------------------------------------------------------------
     | Validation Other Message
     |--------------------------------------------------------------------------
     | Laravel固有のバリデーションメッセージ以外のバリデーションメッセージ
     */
    'other' => [
        'password' => ':nameは半角英数字記号(大文字/小文字)で入力してください。 ※1(数字イチ)とl(英小文字エル)、0(数字ゼロ)とO(英大文字オー)を含まないで入力して下さい。',
        'alpha_num_symbol' => ':nameは半角英数字記号(大文字/小文字)で入力してください。',
        'fifteenMinutes' => ':nameは15分単位で入力してください。',
        'katakana' => ':nameはカタカナで入力してください。',
        'kana' => ':nameはひらがなで入力してください。',
        'english_alphabet' => ':nameはアルファベットで入力してください。',
        'halfwidth_kana_control' => ':nameは全角かなカナ英数字記号、半角英数字記号で入力してください。',
        'amount' => ':nameは半角数字の-9999999～9999999の間で入力してください。',
        'max_add' => ':nameは最大:max件まで追加が可能です。',
        'empty' => ':nameが入力されています。:cause未入力に修正してください。',
        'simple_array_date_format' => ':nameは半角カンマ区切りの「年/月/日」で入力してください。',
        'date_few_format' => ':nameの入力形式が不正です。',
        'after_yesterday' => '本日以降の日付を入力してください。',
        'please_try_again_create' => ':nameが不正です。:nameを再度作成してください',
        'required_least_one' => ':nameは少なくとも1つ、入力してください。',
        'unique_array' => ':nameが重複しています。',
        'outside_hours' => '本日の受付時間は終了いたしました。',
        'two_digits_after_the_decimal_point' => ':nameは小数点第2位までの0より大きい数字で入力してください。',
        'agreement_required' => '同意してください。',
        'input_hash' => ':nameは入力できません。'
    ],
];
