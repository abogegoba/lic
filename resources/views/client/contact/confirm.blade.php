@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','お問合せ：入力内容の確認　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/contact/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li>お問合せ確認</li>
        </ul>
    </nav>
@stop

@section('content')
    <section class="main__content">
        <h2 class="main__content__headline">ご入力いただいた下記の内容で送信いたします。<br>よろしいですか?</h2>
        <p>※ 土日祝日のお問合せへのご回答はお時間がかかる場合がございます。<br>予めご承知おきください。</p>
        {{Form::open(['url'=>route('client.contact.execute')])}}
            <table class="form__table">
                <tr>
                    <th>お問合せ項目</th>
                    <td>{{$data->get('kind')}}</td>
                </tr>
                <tr>
                    <th>氏名</th>
                    <td>{{$data->get('lastName')}}　{{$data->get('firstName')}}</td>
                </tr>
                <tr>
                    <th>氏名かな</th>
                    <td>{{$data->get('lastNameKana')}}　{{$data->get('firstNameKana')}}</td>
                </tr>
                <tr>
                    <th>会社名</th>
                    <td>{{$data->get('companyName')}}</td>
                </tr>
                <tr>
                    <th>部署名</th>
                    <td>{{$data->get('departmentName')}}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{$data->get('tel')}}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{$data->get('mail')}}</td>
                </tr>
                <tr>
                    <th>お問合せ内容</th>
                    <td>{!!nl2br($data->get('contact'))!!}</td>
                </tr>
            </table>
            <div class="form__controls">
                <input type="button" value="修正する" class="prev js-btn-link" data-href="{{route("client.contact.revise")}}">
                <input type="submit" value="送信する" class="submit">
            </div>
        {{Form::close()}}
    </section>
@stop
