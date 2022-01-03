@extends('front.common.root')

@section('title','入力情報の確認│会員登録｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/entry/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/entry/confirm/index.css')}}">
    <style>
        @media only screen and (max-width: 413px) and (min-width: 320px){
            input[type='checkbox'] + label::before {width: 30px;}
            input[type='checkbox']:checked + label::after {top: 5px;}
        }
        @media only screen and (max-width: 639px) and (min-width: 414px){
            input[type='checkbox'] + label::before {width: 24px;}
            input[type='checkbox']:checked + label::after {top: 5px;}
        }
        @media only screen and (max-width: 767px) and (min-width: 640px){
            input[type='checkbox']:checked + label::after {top: -8px;}
        }
    </style>
@stop

@section('content')
    <header id="main__hdr">
        <h1>入力内容の確認</h1>
    </header>
    <div id="main__content">
        <form class="form__confirm">
            <dl>
                <dt>氏名</dt>
                <dd>{{$data->get('lastName')}}　{{$data->get('firstName')}}（{{$data->get('lastNameKana')}}　{{$data->get('firstNameKana')}}）</dd>
                <dt>生年月日</dt>
                <dd>{{$data->get('birthday')}}</dd>
                <dt>証明写真</dt>
                @if($data->get('idPhotoUrl'))
                    <dd><img src="{{ $data->get('idPhotoUrl') }}" alt="証明写真"></dd>
                @else
                    <dd><img src="{{asset('img/mypage/profile/img_self.jpg')}}" alt="証明写真"></dd>
                @endif
            </dl>
            <input type="submit" value="修正" class="form__button js-btn-link" data-href="{{route('front.member-entry.revise-one')}}">
        </form>
        <form class="form__confirm">
            <dl>
                <dt>国籍</dt>
                <dd>{{$data->get('country')}}</dd>
                <dt>現住所</dt>
                <dd>{{$data->get('prefecture')}}{{$data->get('city')}}<br>{{$data->get('blockNumber')}}</dd>
                <dt>連絡先</dt>
                <dd>{{$data->get('phoneNumber')}}</dd>
            </dl>
            <input type="submit" value="修正" class="form__button js-btn-link" data-href="{{route('front.member-entry.revise-two')}}">
        </form>
        <form class="form__confirm">
            <dl>
                <dt>学校情報</dt>
                <dd>{{$data->get('schoolType')}}／{{$data->get('facultyType')}}<br>{{$data->get('name')}}<br>{{$data->get('departmentName')}}<br>{{$data->get('graduationPeriodYear')}}
                    年{{$data->get('graduationPeriodMonth')}}月{{$data->get('graduationPeriodTypeLabel')}}</dd>
            </dl>
            <input type="submit" value="修正" class="form__button js-btn-link" data-href="{{route('front.member-entry.revise-three')}}">
            @if(!empty($errors) && !empty($errors->get("business_exception")['business.cant_store_graduation_period']))
                <div class="error">
                    @include('front.common.business_error', ['errors'=>$errors, 'target'=>'cant_store_graduation_period'])
                </div>
            @endif

        </form>
        <form class="form__confirm">
            <dl>
                <dt>志望情報</dt>
                <dd>
                    <h2>志望業種</h2>
                    <p>{{$data->get('industry1')}}
                        @if(!empty($data->get('industry1')) && !empty($data->get('industry2')))
                            /
                        @endif
                        {{$data->get('industry2')}}
                        @if( !empty($data->get('industry3')&&(!empty($data->get('industry2')) || !empty($data->get('industry1')))))
                            /
                        @endif
                        {{$data->get('industry3')}}</p>
                    <h2>志望勤務地</h2>
                    <p>{{$data->get('location1')}}
                        @if(!empty($data->get('location1')) && !empty($data->get('location2')))
                            /
                        @endif
                        {{$data->get('location2')}}
                        @if( !empty($data->get('location3')&&(!empty($data->get('location2')) || !empty($data->get('location1')))))
                            /
                        @endif
                        {{$data->get('location3')}}</p>
                    <h2>インターン</h2>
                    <p>{{$data->get('intern')}}</p>
                    <h2>就活イベントやその他就職活動に関 する情報取得について</h2>
                    <p>{{$data->get('recruitInfo')}}</p>
                </dd>
            </dl>
            <input type="submit" value="修正" class="form__button js-btn-link" data-href="{{route('front.member-entry.revise-four')}}">
        </form>
        <form class="form__confirm">
            <dl>
                <dt>ID・パスワード</dt>
                <dd>
                    <p>{{$data->get('mailAddress')}}</p>
                    <p class="notice">※メールアドレスをパスワードとして利用します</p>
                    <p class="notice">※パスワードはご入力いただいたものです。</p>
                    <p class="notice">(セキュリティの観点より本画面では非表示です。）</p>
                </dd>
            </dl>
            <input type="submit" value="修正" class="form__button js-btn-link" data-href="{{route('front.member-entry.revise-five')}}">
            @if(!empty($errors) && !empty($errors->get("business_exception")['business.duplication.mail_address']))
                <div class="error">
                    @include('front.common.business_error', ['errors'=>$errors, 'target'=>'duplication.mail_address'])
                </div>
            @endif
        </form>
        {{Form::open(['url'=>route('front.member-entry.store')])}}
        <div class="terms invalid-form">
            <p>新規会員登録の際は「ご利用規約」を必ずお読みいただき、<br class="pc">ご利用規約にご同意の上、登録へお進みください。</p>
            <ul>
                <li><a href="{{route('front.static.term')}}">ご利用規約</a></li>
                <li><a href="{{route('front.static.personal')}}">取り扱いについて</a></li>
            </ul>
            <div class="temrs__consent">
                {{Form::checkbox('agreement', 1, '', ["id"=>"agreement"])}}<label for="agreement">ご利用規約および取り扱いについて同意する</label>
            </div>
            @include('front.common.input_error', ['errors' => $errors, 'targets' => ['agreement']])
        </div>
        <div class="form__controls">
            <input type="button" value="戻る" class="form__controls__prev js-btn-link" data-href="{{route('front.member-entry.revise-five')}}">
            <input type="submit" value="登録する" class="form__controls__register">
        </div>
        {{Form::close()}}
    </div>
@stop
