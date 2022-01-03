@extends('front.common.root')

@section('title','ID・パスワード入力│会員登録｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/entry/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/entry/index5.css')}}">
@stop

@section('content')
    <header id="main__hdr">
        <img src="{{asset('img/entry/icon_title_entry05.png')}}" alt="ID・パスワード入力">
        <div>
            <h1>ID・パスワード入力</h1>
            <p>本サービスのログイン情報をご入力ください。</p>
        </div>
    </header>
    <div id="main__content">
        {{Form::open(['url'=>route('front.member-entry.to-confirm')])}}
            <table class="form__table">
                <tr class="invalid-form">
                    <th class="required"><label for="mailAddress">メールアドレス</label></th>
                    <td>
                        {{Form::email('mailAddress', $data->get("mailAddress"), ["class" => ((!empty($errors->has('mailAddress')) || !empty($errors->get("business_exception")['business.duplication.mail_address'])) ? "invalid-control width100" : "width100"), "id"=>"mailAddress", "placeholder" => "例）example@linkt.jp","maxlength" =>255])}}
                        <p>※メールアドレスはログインIDとしても使います。</p>
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['mailAddress']])
                        @include('front.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'])
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for=pass1>パスワード</label></th>
                    <td>
                        {{Form::password('password',["class" => (!empty($errors->has('password')) ? "invalid-control width100" : "width100"), "id"=>"password", "maxlength" =>14])}}
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['password']])
                    </td>
                </tr>
                <tr class="invalid-form">
                    <th class="required"><label for=pass2>パスワード確認用</label></th>
                    <td>
                        {{Form::password('confirmPassword', ["class" => (!empty($errors->has('confirmPassword')) ? "invalid-control width100" : "width100"), "id"=>"confirmPassword", "maxlength" =>14])}}
                        @include('front.common.input_error', ['errors' => $errors, 'targets' => ['confirmPassword']])
                    </td>
                </tr>
            </table>
            <div class="form__controls">
                <input type="button" value="戻る" class="form__controls__prev js-btn-link" data-href="{{route('front.member-entry.revise-four')}}">
                <input type="submit" value="次に進む" class="form__controls__next">
            </div>
        {{Form::close()}}
    </div>
@stop