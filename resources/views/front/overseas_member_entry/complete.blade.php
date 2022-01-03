@extends('front.common.root')

@section('title','会員登録完了│会員登録｜LinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/entry/common.css')}}">
@stop

@section('content')
    <header id="main__hdr">
        <h1>会員登録完了</h1>
    </header>
    <section id="main__content">
        <h2>会員登録を完了しました。</h2>
        <p>ご登録ありがとうございました。</p>
        <p>ぜひ本サービスをご活用いただき、有意義な就活にお役立てください。</p>
        <p>今後とも本サービスをよろしくお願いいたします。</p>
        <nav>
            <a href="{{route('front.top')}}" class="button">トップへ</a>
            <a href="{{route('front.member.login')}}" class="button">ログインする</a>
        </nav>
    </section>
@stop