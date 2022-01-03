@extends('front.common.root')

@section('title','システムエラー　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/contact/common.css')}}">
@stop

@section('content')
    <section class="main__content" id="complete">
        <h2 class="main__content__headline">システムエラー</h2>
        <p>システムエラーが発生いたしました。</p>
        <p>ご不便をおかけいたしまして申し訳ございません。<br>
            ブラウザを閉じて再度やり直してください。</p>
        <footer class="anchor">
            <a href="{{route('front.top')}}" class="anchor--top">トップへ</a>
        </footer>
    </section>
@stop
