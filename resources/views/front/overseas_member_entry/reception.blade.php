@extends('front.common.root')

@section('title','会員登録の受付完了│会員登録｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/entry/common.css')}}">
@stop

@section('content')
    <header id="main__hdr">
        <h1>会員登録受付完了</h1>
    </header>
    <section id="main__content">
        <h2>会員登録を受付けました</h2>
        <p>ご登録ありがとうございました。</p>
        <p>ご入力いただきましたメールアドレス宛に確認のメールを送付いたしました。</p>
        <p>お手数ですがご確認いただき、手続きを完了してください。</p>
        <nav><a href="{{route('front.top')}}" class="button">トップへ</a>
        </nav>
    </section>
@stop