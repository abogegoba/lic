@extends('front.common.root')

@section('description','新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】の学生向けご利用ガイドです。学生がLinkTを使って就職活動をする際の手順について説明しています。動画や履歴書をアップロードして会員登録を完了させれば、企業探しから採用面接までLinkTのみで行えます。')

@section('title','LinkT（リンクト）の使い方｜次世代の就活ならLinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/describe/base.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/modalwindow.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/chatstyle.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
    <style>
        h2.default {
            color: #fff;
            background: #0080cb !important;
            line-height: 1.6;
        }

        @media only screen and (min-width: 320px) and (max-width: 639px)  {
            #voice-list .inner {
                padding: 0px 10px;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('js/describe/modalwindow.js')}}"></script>
    <script src="{{asset('js/describe/ofi.min.js')}}"></script>
    <script>
        objectFitImages();
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li>利用者の声</li>
        </ul>
    </nav>
@stop

@section('content')
    <section id="voice-list">
        <h2 class="default">利用者の声</h2>
        <div class="inner">
            <div class="user_voice_chatbox">
                <div class="company_user">
                    <img src="{{asset('img/describe/linkt.png')}}" alt="">
                    <div class="user_name_chat">
                        <p class="user_name">LinkT</p>
                        <div class="triangle-right"></div>
                        <div class="chat_msg">
                            <p>全く新しい就活サイト<b>「LinkT」</b>のリアルな声をお届けします！</p>
                            <a href=""></a>
                        </div>
                    </div>
                </div>
                <div class="user_voice">
                    <img src="{{asset('img/describe/vo_ns@2x.png')}}" alt="">
                    <div class="user_name_chat">
                        <p class="user_name">産業能率大学 MKさん</p>
                        <div class="triangle-left"></div>
                        <div class="chat_msg">
                            <p>効率よく就活できる！</p>
                            <a href="{{route('front.static.customer1')}}">詳しくはこちら</a>
                        </div>
                    </div>
                </div>
                <div class="user_voice">
                    <img src="{{asset('img/describe/vo_yk@2x.png')}}" alt="">
                    <div class="user_name_chat">
                        <p class="user_name">大東文化大学 YKさん</p>
                        <div class="triangle-left"></div>
                        <div class="chat_msg">
                            <p>1年生から利用できるから早くスタートが切れる！</p>
                            <a href="{{route('front.static.customer2')}}">詳しくはこちら</a>
                        </div>
                    </div>
                </div>
                <div class="user_voice">
                    <img src="{{asset('img/describe/vo_ja@2x.png')}}" alt="">
                    <div class="user_name_chat">
                        <p class="user_name">日本大学 JAさん</p>
                        <div class="triangle-left"></div>
                        <div class="chat_msg">
                            <p>1社ずつ履歴書を作成する必要がない！</p>
                            <a href="{{route('front.static.customer3')}}">詳しくはこちら</a>
                        </div>
                    </div>
                    <div class="user_voice">
                        <img src="{{asset('img/describe/vo_kh@2x.png')}}" alt="">
                        <div class="user_name_chat">
                            <p class="user_name">亜細亜大学 KHさん</p>
                            <div class="triangle-left"></div>
                            <div class="chat_msg">
                                <p>1社ずつ履歴書を作成する必要がない！</p>
                                <a href="{{route('front.static.customer4')}}">詳しくはこちら</a>
                            </div>
                        </div>
                    </div>
                    <div class="user_voice">
                        <img src="{{asset('img/describe/vo_st@2x.png')}}" alt="">
                        <div class="user_name_chat">
                            <p class="user_name">日本外国語専門学校 STさん</p>
                            <div class="triangle-left"></div>
                            <div class="chat_msg">
                                <p>1社ずつ履歴書を作成する必要がない！</p>
                                <a href="{{route('front.static.customer5')}}">詳しくはこちら</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
