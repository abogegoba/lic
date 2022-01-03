@extends('front.common.root')

@section('title','学生向けログイン｜次世代の就活ならLinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/login/index.css')}}">
@stop

@section('content')
    <h2>ログイン</h2>
    {{Form::open(['url'=>route('front.member.login.execute'),'class'=>"main__form"])}}
        <div class="invalid-form">
            <label for="mailAddress" class="required">メールアドレス</label>
            {{Form::email('mailAddress', $data->get("mailAddress"), ["class" => (!empty($errors->has('mailAddress')) ? "invalid-control width100" : "width100"), "id"=>"mail","placeholder"=>"例）example@linkt.jp"])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['mailAddress']])
        </div>
        <div class="invalid-form">
            <label for="password" class="required">パスワード</label>
            {{Form::password('password', $data->get("member.password"), ["class" => (!empty($errors->has('password')) ? "invalid-control" : ""), "id"=>"password"])}}
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['password']])
            @include('front.common.business_error', ['errors'=>$errors, 'target'=>'authentication_failed_front'])
        </div>
        <div class="form__controls">
            <input type="submit" value="ログインする">
        </div>
        <div style="text-align: center; margin-top: 30px;">会員登録がまだの方はこちら</div>
        <div class="form__controls">
            @php
                $entryUrl = route('front.static.select_entry');
            @endphp
            <input
                type="button"
                onclick="location.href='{{ $entryUrl }}'"
                value="会員登録"
                style="background-color: #E60012; margin-top: 10px;"
            >
        </div>
    </div>
    {{Form::close()}}
@stop

