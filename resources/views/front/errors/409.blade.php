@extends('front.common.root')

@section('title','システムエラー　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/contact/common.css')}}">
@stop

@section('content')
    <section class="main__content" id="complete">
        <h2 class="main__content__headline">
            @foreach($errors as $error)
                {{$error}} <br>
            @endforeach</h2>
        <p>申し訳ございませんが、正しく表示できませんでした。</p>
        <p>ご不便をおかけいたしまして申し訳ございません。<br>
            ブラウザを閉じて再度やり直してください。</p>
        <footer class="anchor">
            <a onclick="location.href='{{$backUrl}}'" class="anchor--top cursor-pointer">戻る</a>
            <a href="{{route('front.top')}}" class="anchor--top">トップへ</a>
        </footer>
    </section>
@stop
