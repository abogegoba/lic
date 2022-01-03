@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','問合せ：送信完了　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/contact/common.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li>お問合せ完了</li>
        </ul>
    </nav>
@stop

@section('content')
    <section class="main__content" id="complete">
        <h2 class="main__content__headline">ご入力いただいた内容でお問合せを送信しました。</h2>
        <p>お問合せありがとうございました。</p>
        <p>※ 土日祝日のお問合せへのご回答はお時間がかかる場合がございます。<br>予めご承知おきください。</p>
        <footer class="anchor">
            <a href="{{route('client.top')}}" class="anchor--top">トップへ</a>
        </footer>
    </section>
@stop