@extends('front.common.root')

@section('description','会員登録：基本情報入力')

@section('title','ID・パスワード│プロフィール変更│マイページ｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/profile/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.company.list')}}">マイページ</a></li>
            <li>プロフィール変更入力（ID・パスワード）</li>
        </ul>
    </nav>
@stop
@section('content')
    @include('front.common.mypage_menu')
    <div class="main__content">
        {{Form::open(['url'=>route('front.profile.id-and-pass.edit.store')])}}
        <table class="form__table">
            <tr class="invalid-form">
                <th class="required"><label for="mailAddress">メールアドレス</label></th>
                <td>
                    {{Form::email('mailAddress', $data->get("mailAddress"), ["class" => ((!empty($errors->has('mailAddress')) || !empty($errors->get("business_exception")['business.duplication.mail_address'])) ? "invalid-control width100" : "width100"), "id"=>"mailAddress", "placeholder" => "例）example@linkt.jp","maxlength" =>255])}}
                    <p class="notice">※メールアドレスはログインIDとしても使います。</p>
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['mailAddress']])
                    @include('front.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="password">パスワード</label></th>
                <td>

                    {{Form::password('password', ["class" => (!empty($errors->has('password')) ? "invalid-control" : ""), "id"=>"password", "maxlength" =>14])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['password']])
                </td>
            </tr>
            <tr class="invalid-form">
                <th class="required"><label for="confirmPassword">パスワード確認用</label></th>
                <td>
                    {{Form::password('confirmPassword',  ["class" => (!empty($errors->has('confirmPassword')) ? "invalid-control" : ""), "id"=>"confirmPassword","maxlength" =>14])}}
                    @include('front.common.input_error', ['errors' => $errors, 'targets' => ['confirmPassword']])
                </td>
            </tr>
        </table>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="{{route("front.profile")}}">
            <input type="submit" value="保存する" class="save">
        </div>
        {{Form::close()}}
    </div>
@stop
