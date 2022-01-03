<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin/skin-blue.css') }}">
</head>

<body>
<div class="wrapper">
    {{Form::open(['url'=>route('admin.login')])}}
        <div class="login-box">
            <div class="login-title">
                <h1 class="sr-only">LinkT</h1>
                <img src="{{ asset('img/common/logo_header.png') }}" alt="LinkT">
            </div>
            <div class="login-box-body">
                <div class="form-group mb-4 @if($errors->has("mailAddress") || $errors->has("business_exception")) invalid-form @endif">
                    <label for="mailAddress" class="sr-only">ユーザーID</label>
                    <div class="input-group">
                        {{Form::text('mailAddress',null,["id"=>"mailAddress","class"=>"form-control invalid-control","placeholder"=>"メールアドレス"])}}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user fa-lg icon"></i>
                            </div>
                        </div>
                    </div>
                    @include("admin.common.input_error",["target"=>"mailAddress"])
                </div>
                <div class="form-group @if($errors->has("password") || $errors->has("business_exception")) invalid-form @endif">
                    <label for="password" class="sr-only">パスワード</label>
                    <div class="input-group">
                        {{Form::password('password',["id"=>"password","class"=>"form-control invalid-control","placeholder"=>"パスワード入力"])}}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="far fa-id-card fa-lg icon"></i>
                            </div>
                        </div>
                    </div>
                    @include("admin.common.input_error",["target"=>"password"])
                </div>
                @include("admin.common.input_error",["target"=>"business_exception"])
            </div>
            <div class="login-box-footer">
                <div class="btn-row btn-row-md">
                    <div class="btn-col">
                        <button type="submit" class="btn btn-outline-light btn-lg js-btn-submit">
                            ログイン
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {{Form::close()}}
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
</body>
</html>