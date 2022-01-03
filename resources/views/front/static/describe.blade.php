@extends('front.common.root')

@section('description','新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】の学生向けご利用ガイドです。学生がLinkTを使って就職活動をする際の手順について説明しています。動画や履歴書をアップロードして会員登録を完了させれば、企業探しから採用面接までLinkTのみで行えます。')

@section('title','LinkT（リンクト）の使い方｜次世代の就活ならLinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/describe/base.css')}}">
    <link rel="stylesheet" href="{{asset('css/describe/common.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/describe/modalwindow.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/describe/chatstyle.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
    <style>
        #P07 h2.default {
            color: #fff;
            background: #0080cb !important;
            line-height: 1.6;
        }
        .user_voice_chatbox {
            padding: 0px 75px;
        }
        @media only screen and (max-width: 1023px) and (min-width: 768px){
            .company_user {
                margin-left: calc(100% - 500px);
            }
        }
        @media only screen and (max-width: 640px) and (min-width: 320px){
            .user_voice_chatbox {
                padding: 0px 10px;
            }
        }

        #browser_recommandation_container {padding: 50px 150px 0;text-align: justify;line-height: 1.5;font-size: 15px;}
        #browser_recommandation_container>p {margin-bottom: 1.5em;font-weight: 700;color: #2a2a2a;font-size: 15px;}
        #browser_support {margin-bottom: 1.5em;}
        #browser_support p {font-weight: 700;color: #2a2a2a;}
        #pc_browser,#mobile_browser {border-left: 3px solid #0081CC;padding-left: 15px;margin-bottom: 15px;}
        #pc_browser ul,#mobile_browser ul {display: inline-grid;min-width: 40%;}
        #pc_browser ul li, #mobile_browser ul li {list-style: disc;margin-left: 30px;}

        @media only screen and (max-width: 767px) and (min-width: 320px){
            #browser_recommandation_container {padding: 25px 25px;}
            #browser_support {font-size: 15px;}
        }
        @media only screen and (max-width: 1024px) and (min-width: 768px){
            #browser_recommandation_container {padding: 0px 120px;}
            #browser_support {font-size: 15px;}
        }
    </style>
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    {{--<script src="{{asset('js/describe/modalwindow.js')}}"></script>--}}
    <script src="{{asset('js/describe/library.js')}}"></script>
    <script src="{{asset('js/describe/ofi.min.js')}}"></script>
    <script>
        objectFitImages();
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li>LinkTの使い方</li>
        </ul>
    </nav>
@stop

@section('content')
    <div class="main__catch requid describe">

        <div class="mv">
            <h1>
                <picture>
                    <source media="(max-width: 768px)" srcset="{{asset('img/describe/main.jpg')}}">
                    <img src="{{asset('img/describe/main_w.png')}}" alt="自宅で就活" class="auto">
                </picture>
            </h1>
        </div>

        <main>
            <section id="P01">
                <div class="inner">
                    <h2 class="default large">採用担当者と直接つながる<br>就活の新しいカタチ</h2>
                    <p>LinkTは採用担当者と直接つながれる<br>今までになかった就活サイト。</p>
                    <a href="{{route('front.static.use')}}" class="btn">▶ ご利用の流れはこちら</a>
                </div>
            </section>

            <section id="P02">
                <div class="bg">
                    <div class="bg-pc"><img src="{{asset('img/describe/cat1_1_w.jpg')}}" alt="あなたの魅力を直接プレゼン！" class="auto"></div>
                    <h2 class="default cw large">あなたの魅力を直接プレゼン！</h2>
                    <p class="cw">LinkTの最大のポイントは<br>採用担当者へ直接アピールできること！<br>採用担当者のハートをグッとつかむ<br>プロフィールを作成しよう！</p>
                </div>
                <div class="inner">
                    <div class="frame2">
                        <div class="frame">
                            <h2 class="default">採用担当者から注目される<br>WEB履歴書作成のポイント</h2>
                            <div class="point"><p>をタップして作成のポイントを確認<br>効果的なプロフィールを作成しよう!</p></div>
                        </div>
                        <div class="profile">
                            <img src="{{asset('img/describe/profile.png')}}" alt="LinkT プロフィール画面" class="auto">
                            <a href="javascript:;" data-openmodal="point1" class="point1"><img src="{{asset('img/describe/point.png')}}" alt="POINT" class="auto"></a>
                            <a href="javascript:;" data-openmodal="point2" class="point2"><img src="{{asset('img/describe/point.png')}}" alt="POINT" class="auto"></a>
                            <a href="javascript:;" data-openmodal="point3" class="point3"><img src="{{asset('img/describe/point.png')}}" alt="POINT" class="auto"></a>
                            <a href="javascript:;" data-openmodal="point4" class="point4"><img src="{{asset('img/describe/point.png')}}" alt="POINT" class="auto"></a>
                        </div>
                    </div>
                    @if(empty($memberAuthentication))
                        <a href="{{route('front.static.select_entry')}}" class="btn2">会員登録</a>
                    @endif
                </div>
            </section>

            <section id="P03">
                <div class="bg">
                    <div class="position">
                        <div>
                            <picture>
                                <source media="(min-width: 768px)" srcset="{{asset('img/describe/cat2_1_w.png')}}">
                                <img src="{{asset('img/describe/cat2_1.jpg')}}" alt="image" class="auto">
                            </picture>
                        </div>
                        <div><h2 class="default pco">プロフィールを充実させることで<br>あなたに興味を持った企業から<br>メッセージが届く！</h2></div>
                    </div>
                </div>
                <div class="inner">
                    <div class="frame">
                        <h2 class="default spo">プロフィールを充実させることで<br>あなたに興味を持った企業から<br>メッセージが届く！</h2>
                        <div class="image"><img src="{{asset('img/describe/cat2_3.jpg')}}" alt="あなたに興味を持った企業からメッセージが届く！" class="auto"><p>あなたに興味を持った企業から<br>メッセージが届く！</p></div>
                        <div class="position">
                            <div class="imagev">
                                <picture>
                                    <source media="(min-width: 768px)" srcset="{{asset('img/describe/cat2_2_w.png')}}">
                                    <img src="{{asset('img/describe/cat2_2.jpg')}}" alt="image" class="auto">
                                </picture>
                            </div>
                            <div class="text">
                                <h2 class="default">あなた以外の学生があなたの<br>プロフィールを見ることは<br>できないので安心</h2>
                                <p>プロフィールは企業の採用担当者のみが閲覧できます！<br class="pc">他人の目を気にせず自由に自己PRして、ライバルと差をつけよう！</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="P04">
                <div class="bg">
                    <picture>
                        <source media="(min-width: 768px)" srcset="{{asset('img/describe/cat3_1_w.png')}}">
                        <img src="{{asset('img/describe/cat3_1.jpg')}}" alt="image" class="auto">
                    </picture>
                </div>
                <div class="inner">
                    <div class="frame">
                        <h2 class="default">自己PR動画で<br>全国の企業へアピール！</h2>
                        <p>動画を使って内定をつかみとろう！</p>
                        <div class="row">
                            <div class="image">
                                <div class="video-wrap">
                                    <video class="video" controls="controls" muted="muted" loop="loop" preload="none" poster="{{asset('img/describe/customer1_ss.jpg')}}">
                                        <source src="{{asset('video/describe/customer1.mp4')}}"><p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                    {{--<div class="video-btn"></div>--}}
                                </div>
                                <p>法政大学 NSさん</p>
                            </div>
                            <div class="image">
                                <div class="video-wrap">
                                    <video class="video" controls="controls" muted="muted" loop="loop" preload="none" poster="{{asset('img/describe/customer2_ss.jpg')}}">
                                        <source src="{{asset('video/describe/customer2.mp4')}}"><p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                    {{--<div class="video-btn"></div>--}}
                                </div>
                                <p>学習院大学 MSさん</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="P05">
                <div class="bg spo"><img src="{{asset('img/describe/cat4_1.jpg')}}" alt="image" class="auto"></div>
                <div class="inner">
                    <div class="frame">
                        <div class="position">
                            <div class="pco"><img src="{{asset('img/describe/cat4_1_w.png')}}" alt="image" class="auto"></div>
                            <div>
                                <h2 class="default">オンライン面接で<br>効率よく活動！</h2>
                                <p>オンライン面接が当たり前の時代に！<br class="pc">自宅で面接ができることで効率の良い就活を実現させます！</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="image"><img src="{{asset('img/describe/cat4_p1.jpg')}}" class="auto" alt="メッセージから面接依頼"><p>メッセージから面接依頼</p></div>
                            <div class="image"><img src="{{asset('img/describe/cat4_p2.jpg')}}" class="auto" alt="オンライン面接URLが届く"><p>オンライン面接URLが届く</p></div>
                            <div class="image"><img src="{{asset('img/describe/cat4_p3.jpg')}}" class="auto" alt="面接予約の確認"><p>面接予約の確認</p></div>
                            <div class="image"><img src="{{asset('img/describe/cat4_p4.jpg')}}" class="auto" alt="面接時間になったらURLをタップして入室"><p>面接時間になったらURLをタップして入室</p></div>
                            <div class="image"><img src="{{asset('img/describe/cat4_p5.jpg')}}" class="auto" alt="面接結果もメッセージ画面で確認"><p>面接結果もメッセージ画面で確認</p></div>
                        </div>
                    </div>
                    @if(empty($memberAuthentication))
                        <a href="{{route('front.static.select_entry')}}" class="btn2">会員登録</a>
                    @endif
                </div>
            </section>

            <section id="P06">
                <div class="inner">
                    <h2 class="default cw">オンライン面接のポイント！</h2>
                    <div class="point_item">
                        <h3>リクルートスーツ着用での面接を推奨します！</h3>
                        <img src="{{asset('img/describe/p_01.jpg')}}" alt="リクルートスーツ着用での面接を推奨します！" class="auto">
                    </div>
                    <div class="point_item">
                        <h3>部屋の照明を明るくして、<br>整理整頓された綺麗な部屋で<br>面接することで面接官からの評価アップ!</h3>
                        <img src="{{asset('img/describe/p_02.jpg')}}" alt="部屋の照明を明るくして、整理整頓された綺麗な部屋で面接することで面接官からの評価アップ!" class="auto">
                    </div>
                    <div class="point_item">
                        <div>
                            <div>
                                <h3>画面がブレないように、<br>スマートフォンはしっかり固定しよう!</h3>
                                <p>※PCでも利用可能</p>
                            </div>
                        </div>
                        <img src="{{asset('img/describe/p_03.jpg')}}" alt="画面がブレないように、スマートフォンはしっかり固定しよう!" class="auto">
                    </div>
                </div>
            </section>

            <section id="P07">
                <div class="inner">
                    <h2 class="default">利用者の声</h2>
                    {{--<div class="row">
                        <a href="{{route('front.static.customer1')}}"><img src="{{asset('img/describe/vo_ns.jpg')}}" alt="法政大学 NSさん" class="auto"><p>法政大学 NSさん</p></a>
                        <a href="{{route('front.static.customer2')}}"><img src="{{asset('img/describe/vo_ms.jpg')}}" alt="学習院大学 MSさん" class="auto"><p>学習院大学 MSさん</p></a>
                        <a href="{{route('front.static.customer3')}}"><img src="{{asset('img/describe/vo_mk.jpg')}}" alt="明治学院大学 MKさん" class="auto"><p>明治学院大学 MKさん</p></a>
                    </div>
                    <a href="{{route('front.static.customer')}}" class="btn">▶ 利用者の声一覧はこちら</a>--}}
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
                                <p class="user_name">法政大学 NSさん</p>
                                <div class="triangle-left"></div>
                                <div class="chat_msg">
                                    <p>効率よく就活できる！</p>
                                    <a href="{{route('front.static.customer1')}}">詳しくはこちら</a>
                                </div>
                            </div>
                        </div>
                        <div class="user_voice">
                            <img src="{{asset('img/describe/vo_ms@2x.png')}}" alt="">
                            <div class="user_name_chat">
                                <p class="user_name">学習院大学 MSさん</p>
                                <div class="triangle-left"></div>
                                <div class="chat_msg">
                                    <p>1年生から利用できるから早くスタートが切れる！</p>
                                    <a href="{{route('front.static.customer2')}}">詳しくはこちら</a>
                                </div>
                            </div>
                        </div>
                        <div class="user_voice">
                            <img src="{{asset('img/describe/vo_mk@2x.png')}}" alt="">
                            <div class="user_name_chat">
                                <p class="user_name">明治学院大学 MKさん</p>
                                <div class="triangle-left"></div>
                                <div class="chat_msg">
                                    <p>1社ずつ履歴書を作成する必要がない！</p>
                                    <a href="{{route('front.static.customer3')}}">詳しくはこちら</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('front.static.customer')}}" class="btn">▶ 利用者の声一覧</a>
                </div>
            </section>

            <section id="P08">
                <div class="inner">
                    <h2>対応OS・ブラウザについて</h2>
                    {{--<p>対応OS・ブラウザのバージョン一覧</p>
                    <div class="row">
                        <div>
                            <h3>PC</h3>
                            <dl>
                                <dt>Windows<br>7/10</dt>
                                <dd>Firefox最新版<br>Google Chrome最新版</dd>
                                <dt>MacOS X<br>最新版</dt>
                                <dd>Safari最新版</dd>
                            </dl>
                        </div>
                        <div>
                            <h3>スマートフォン</h3>
                            <dl>
                                <dt>iOS<br>最新版</dt>
                                <dd>標準ブラウザ<br>（Safari最新版）</dd>
                                <dt>Android<br>最新版</dt>
                                <dd>標準ブラウザ<br>（Google Chrome最新版）</dd>
                            </dl>
                        </div>
                    </div>--}}
                    <div id="browser_recommandation_container">
                        <p>ご利用上のご注意 <br> LinkTを安全にご利用いただくためには、下記デバイス・ブラウザのご利用を推奨いたします。</p>
                        <div id="browser_support">
                            <div id="pc_browser">
                                <p>PC</p>
                                <ul>
                                    Windows
                                    <li>Google Chrome 最新版</li>
                                    <li>Firefox 最新版</li>
                                </ul>
                                <ul>
                                    Mac
                                    <li>Google Chrome 最新版</li>
                                    <li>Firefox 最新版</li>
                                    <li>Safari 最新版</li>
                                </ul>
                            </div>
                            <div id="mobile_browser">
                                <p>スマートフォン</p>
                                <ul>
                                    iOS
                                    <li>Safari 最新版（標準ブラウザ）</li>
                                </ul>
                                <ul>
                                    Android
                                    <li>Google Chrome 最新版（標準ブラウザ）</li>
                                </ul>
                            </div>
                            <p>※上記以外のデバイス・ブラウザでご利用された場合には、表示や一部機能に不具合が生じる恐れがございますので予めご了承ください。</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="P09">
                <div class="inner">
                    @if(empty($memberAuthentication))
                        <a href="{{route('front.static.select_entry')}}" class="btn2">会員登録</a>
                    @endif
                </div>
            </section>
        </main>
    </div>

    <div class="modalwindow" id="point1">
        <div class="body">
            <div class="window-close" data-closemodal="point1"><img src="{{asset('img/describe/x.png')}}" alt="×" class="auto"></div>
            <h2>ハッシュタグ</h2>
            <div class="main">
                <p>自分を一言で表すハッシュタグを作成して採用担当者にインパクトを残そう！</p>
                <div class="image"><img src="{{asset('img/describe/point1_hashtag.jpg')}}" alt="ハッシュタグ"></div>
                <ul class="check">
                    <li>・パッと見た時のインパクトを意識！</li>
                    <li>・できるだけ文字数を少なくしシンプルに作成！</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modalwindow" id="point2">
        <div class="body">
            <div class="window-close" data-closemodal="point2"><img src="{{asset('img/describe/x.png')}}" alt="×" class="auto"></div>
            <h2>プロフィール写真</h2>
            <div class="main">
                <p>その人の印象は10秒で決まる。<br>そんな法則はネットにも当てはまります。<br>ポイントを押さえて担当者に好印象を与える<br>プロフィール写真を掲載しよう！</p>
                <div class="image"><img src="{{asset('img/describe/point1_photo.png')}}" alt="プロフィール写真"></div>
                <ul class="check">
                    <li>・バストアップの写真を用意！</li>
                    <li>・服装はスーツで好印象！</li>
                    <li>・髪型は清潔感をアピール！</li>
                    <li>・自然な笑顔を大切に！</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modalwindow" id="point3">
        <div class="body">
            <div class="window-close" data-closemodal="point3"><img src="{{asset('img/describe/x.png')}}" alt="×" class="auto"></div>
            <h2>自己PR文</h2>
            <div class="main">
                <p>自分がどんな人物なのか採用担当者にわかりやすく伝わるように文章を作成しよう！</p>
                <div class="image"><img src="{{asset('img/describe/point3_text.jpg')}}" alt="自己PR文"></div>
                <ul class="check">
                    <li>・わかりやすい文章を心がける！</li>
                    <li>・自分の就活に対する意気込みを精一杯伝える！</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modalwindow" id="point4">
        <div class="body">
            <div class="window-close" data-closemodal="point4"><img src="{{asset('img/describe/x.png')}}" alt="×" class="auto"></div>
            <h2>自己PR動画</h2>
            <div class="main">
                <p>動画あるのとないのでは大違い！<br>実際に動画を載せて企業からのオファーをもらった学生多数！</p>
                <div class="image"><img src="{{asset('img/describe/point4_movie.jpg')}}" alt="自己PR動画"></div>
                <ul class="check">
                    <li>・動画のタイトルを作成！</li>
                    <li>・動画尺は30秒～1分が目安！</li>
                </ul>
            </div>
        </div>
    </div>
@stop
