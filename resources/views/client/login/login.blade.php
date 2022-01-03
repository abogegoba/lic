@extends('client.common.root')

@section('title','企業向けログイン｜新卒・第二新卒採用ならLinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/login/index.css')}}">
@stop

@section('content')
    <h2>ログイン</h2>
    {{Form::open(['url'=>route('client.login.execute'),'class'=>"main__form"])}}
        <div class="invalid-form">
            <label for="mailAddress" class="required">メールアドレス</label>
            {{Form::email('mailAddress', $data->get("mailAddress"), ["class" => (!empty($errors->has('mailAddress')) ? "invalid-control width100" : "width100"), "id"=>"mail","placeholder"=>"例）example@linkt.jp"])}}
            @include('client.common.input_error', ['errors' => $errors, 'targets' => ['mailAddress']])
        </div>
        <div class="invalid-form">
            <label for="password" class="required">パスワード</label>
            {{Form::password('password', $data->get("member.password"), ["class" => (!empty($errors->has('password')) ? "invalid-control" : ""), "id"=>"password"])}}
            @include('client.common.input_error', ['errors' => $errors, 'targets' => ['password']])
            @include('client.common.business_error', ['errors'=>$errors, 'target'=>'authentication_failed_front'])
        </div>
        <div class="form__controls">
            <input type="submit" value="ログインする">
        </div>
    {{Form::close()}}
@stop

