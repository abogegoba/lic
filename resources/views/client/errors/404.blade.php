@extends('client.common.root')

@section('title','ページが見つかりません　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/mypage/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/mypage/contact/common.css')}}">
@stop

@section('content')
    <section class="main__content" id="complete">
        <h2 class="main__content__headline">ページが見つかりません</h2>
        <p>お探しのページは見つかりませんでした。申し訳ございません。<br>
            ご指定のページは存在しないか移動した可能性がございます。</p>
        <footer class="anchor">
            <a href="{{route('client.top')}}" class="anchor--top">トップへ</a>
        </footer>
    </section>
@stop
