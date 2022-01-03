<?php $__env->startSection('description','次世代型新卒・第二新卒採用サービス【LinkT（リンクト）】は、企業の採用活動におけるコストや労力、情報格差を改善することができる新しい人材採用サービスです。LinkTによって採用活動の質を上げ、優秀な人材を確保することができます。'); ?>

<?php $__env->startSection('title','LinkT(リンクト) -企業向けTOP-│次世代型新卒・第二新卒採用サービス'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/client/index.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/client/index_custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('js/slick/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('js/slick/slick_custome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('js/slick/slick-theme.css')); ?>">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        @media  screen and (min-width: 600px){
            #device_capability {
                top: 80px;
            }
        }
        @media  screen and (min-width: 320px) and (max-width: 599px){
            #device_capability {
                top: 50px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/top/top.js')); ?>"></script>
    <script>
        $(function () {
            $('#media_slider').slick({
                arrows: true,
                dots: false,
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 801,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            arrows: false,
                            autoplay: true,
                            autoplaySpeed: 2000,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            $(function () {
                var headerHight = 500; //ヘッダの高さ
                $('a[href^=#main__qa--link]').click(function(){
                    var href= $(this).attr("href");
                    var target = $(href == "#" || href == "" ? 'html' : href);
                    var position = target.offset().top - 500; //ヘッダの高さ分位置をずらす
                    $("html, body").animate({scrollTop:position});　//この数値は移動スピード
                    return false;
                });
            });
            //リンクをクリックしたら、メニューを閉じる
            $("#qaLink").on("click", function() {
                $('#gnav').hide();
                // location.replace('#qa');
            });
            $('#qa__list--open').on("click", function() {
                // メニュー表示/非表示
                $(this).toggleClass('main__close').next('dl').slideToggle();
            });
            // 子メニュー処理
            $('.main__qa--more-qa').on("click",function(e) {
                // メニュー表示/非表示
                $(this).toggleClass('close').next('dd').slideToggle();
                e.stopPropagation();
            });


        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="main__catch requid">
        <div class="main__catch__inner">
            <h2 class="main__catch__heading">新卒採用を成功へ</h2>
            <p>PC／スマートフォンで学生探しから<br class="sp">面接まで可能にするサービス。<br>時間、コスト、情報量を圧倒的に改善し、<br class="sp">採用活動の成果をあげます。</p>
        </div>
        <nav class="navSp main__catch__nav">
            <a href="<?php echo e(route('client.contact')); ?>">企業会員登録</a>
            <a href="<?php echo e(route('client.static.use')); ?>">使い方はこちら</a>
        </nav>
        <picture>
            <source media="(max-width: 767px)" srcset="<?php echo e(asset('img/client/index/photo_main-sp.jpg')); ?>">
            <img src="<?php echo e(asset('img/client/index/photo_main-pc.jpg')); ?>" alt="就活の新時代へ">
        </picture>
    </section>
    <section class="main__media requid">
        <div class="main__media__inner">
            <h2 class="headline">MEDIA<span>メディア掲載</span></h2>

            <div id="media_slider" class="main__media_elements">
                <div class="slick-slide media_element media_image_bg_blc">
                    <div class="media__item__img img--logo">
                        <img src="<?php echo e(asset('img/client/media/1_2x.png')); ?>" alt="">
                    </div>
                    <div class="media_text">
                        テレビ山口【tys情報PickUp】 に取り上げられました。
                    </div>
                </div>
                <div class="slick-slide media_element media_image_bg_wh">
                    <div class="media__item__img img--logo">
                        <img src="<?php echo e(asset('img/client/media/2_2x.png')); ?>" alt="">
                    </div>
                    <div class="media_text">
                        大分放送【アレ・コレBOX】 に取り上げられました。
                    </div>
                </div>
                <div class="slick-slide media_element media_image_bg_wh">
                    <div class="media__item__img img--logo">
                        <img src="<?php echo e(asset('img/client/media/3.jpg')); ?>" alt="">
                    </div>
                    <div class="media_text">
                        中国放送【ランキンLand！】 に取り上げられました。
                    </div>
                </div>
                <div class="slick-slide media_element media_image_bg_wh">
                    <div class="media__item__img img--logo">
                        <img src="<?php echo e(asset('img/client/media/4_2x.png')); ?>" alt="">
                    </div>
                    <div class="media_text">
                        長崎放送【あっぷる】 に取り上げられました。
                    </div>
                </div>
                <div class="slick-slide media_element media_image_bg_wh">
                    <div class="media__item__img img--logo">
                        <img src="<?php echo e(asset('img/client/media/5_2x.png')); ?>" alt="">
                    </div>
                    <div class="media_text">
                        長野朝日放送【今ドキ！昼ドキッ】 に取り上げられました。
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- <section class="main__news requid">
        <div class="main__news__inner">
            <h2 class="headline">NEWS<span>ニュース</span></h2>
            <table>
                <tr>
                    <td>2020/03/03（火）
                        <span class="mobile_view label label-blue">ニュースリリース</span><br>
                        <a class="mobile_view" href="<?php echo e(route('client.news.detail_4')); ?>" rel="noopener">LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施</a>
                    </td>
                    <td class="web_view"><span class="label label-blue">ニュースリリース</span></td>
                    <td class="web_view"><a href="<?php echo e(route('client.news.detail_4')); ?>" rel="noopener">LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施</a></td>
                </tr>
                <tr>
                    <td>2020/03/03（火）
                        <span class="mobile_view label label-blue">ニュースリリース</span><br>
                        <a class="mobile_view" href="<?php echo e(route('client.news.detail_5')); ?>">LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨</a>
                    </td>
                    <td class="web_view"><span class="label label-blue">ニュースリリース</span></td>
                    <td class="web_view"><a href="<?php echo e(route('client.news.detail_5')); ?>">LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨</a></td>
                </tr>
            </table>

            <nav><a href="<?php echo e(route('client.news.list')); ?>">ニュース一覧</a></nav>
        </div>
    </section> -->
    <section class="main__about requid">
        <div class="main__about__inner">
            <div>
                <h2 class="headline">LinkTとは</h2>
                <h3>新卒（第二新卒含む）採用を<br class="sp">成功へ導くサービスです。</h3>
                <p>時間、コスト、情報量が必要な新卒採用市場。<br>優秀な学生を採用することは企業発展に<br class="sp">必要不可欠な要素にもかかわらず、<br>多くの企業様は採用活動に<br class="sp">満足されていないのではないでしょうか。<br>LinkTは企業様のお悩みを解决できる<br
                            class="sp">新しい仕組みをご提供し、<br>本当に欲しい人材を効率的に獲得する<br class="sp">サポートをいたします。</p>
                <div class="main__about__video" id="video-wrap">
                    <video controlsList="nodownload" id="video" controls="" loop="" preload="none" poster="<?php echo e(asset('img/client/index/poster.jpg')); ?>">
                        <source src="<?php echo e(asset('video/introduction-for-clients.mp4')); ?>">
                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                    </video>
                    <label class="" id="video-btn"></label>
                    <a href="javascript:void(0);" id="js-video-play">紹介動画を見る</a>
                </div>
                <nav>
                    <a href="<?php echo e(route('client.contact')); ?>">企業会員登録</a>
                    <a href="<?php echo e(route('client.static.use')); ?>">使い方はこちら</a>
                </nav>
            </div>
        </div>
    </section>
    <section class="main__problem requid">
        <div>
            <h2 class="headline">こんなお悩みは<br>ないでしょうか？</h2>
            <ul>
                <li>自社が学生に認知されていないから応募数が少ない</li>
                <li>情報量が少ないから優秀な学生の見極めが難しい</li>
                <li>インターン選考の精度が低い</li>
                <li>採用活動には時間と多くの労力がかかるうえに、成果が乏しい</li>
                <li>採用活動にかかる人件費、その他コストが高い</li>
            </ul>
        </div>
    </section>
    <section class="main__feature">
        <h2 class="headline">LinkTの特徴</h2>
        <p>企業・学生双方向からの検索・コンタクト・面接が可能に。<br>双方をPRする機能も搭載したマッチング型の採用システム</p>
        <div class="main__feature__functions">
            <figure>
                <img src="<?php echo e(asset('img/client/index/circle_feature01.png')); ?>" alt="特徴1">
                <figcaption>全国の学生を検索。<br>自己PR動画や履歴書を<br>見て情報収集。</figcaption>
            </figure>
            <figure>
                <img src="<?php echo e(asset('img/client/index/circle_feature02.png')); ?>" alt="特徴2">
                <figcaption>メッセージ機能で<br>気になる学生へコンタクト</figcaption>
            </figure>
            <figure>
                <img src="<?php echo e(asset('img/client/index/circle_feature03.png')); ?>" alt="特徴3">
                <figcaption>自社PR動画の掲載。<br>御社に興味を持った学生から<br>メッセージがが届きます。</figcaption>
            </figure>
            <figure>
                <img src="<?php echo e(asset('img/client/index/circle_feature04.png')); ?>" alt="特徴4">
                <figcaption>オンライン面接にて先行実施。<br>（インターン選考含む）</figcaption>
            </figure>
        </div>
        <img src="<?php echo e(asset('img/client/index/arrow_feature.png')); ?>" alt="結果">
        <div class="main__feature__results">
            <p>学生の情報量の拡大</p>
            <p>自社PRの成功</p>
            <p>時間の効率化</p>
            <p>コストの削減</p>
        </div>
        <footer>質の高い採用活動（インターン選考含む）を<br class="sp">実現できます。</footer>
    </section>
    <section class="main__example">
        <h2 class="headline headline--decolines">ご利用例</h2>
        <div>
            <h3>A社様</h3>
            <img src="<?php echo e(asset('img/client/index/icon_example01.png')); ?>" alt="A社様">
            <p>学生検索から気になる学生へコンタクトし、後日オンライン面接実施。<br>メッセージにて二次面接通過のご連絡をし、最終面接は本社にて直接面談。</p>
        </div>
        <div>
            <h3>B社様</h3>
            <img src="<?php echo e(asset('img/client/index/icon_example02.png')); ?>" alt="B社様">
            <p>B社様の企業動画や企業情報を閲覧した学生からメッセージが届く。<br>後日オンライン面接を実施し、メッセージにて内定通知のご連絡。</p>
        </div>
        <div>
            <h3>C社様</h3>
            <img src="<?php echo e(asset('img/client/index/icon_example03.png')); ?>" alt="C社様">
            <p>インターン参加学生を希望する企業様。学生検索から気になる学生へコンタクトし、後日オンライン面接実施。メッセージにてインターン選考通知のご連絡。</p>
        </div>
        <nav class="navSp">
            <a href="<?php echo e(route('client.contact')); ?>">企業会員登録</a>
            <a href="<?php echo e(route('client.static.use')); ?>">使い方はこちら</a>
        </nav>
    </section>
    <section class="main__regist">
        <div>
            <h2 class="headline headline--decolines">登録の流れ</h2>
            <dl>
                <dt>STEP1</dt>
                <dd>
                    <p>《企業登録》にて弊社へ<br class="sp">お問合せくださいませ。</p>
                </dd>
                <dt>STEP2</dt>
                <dd>
                    <p>弊社より貴社メールアドレス宛にユーザーID、パスワードのご発行をいたします。</p>
                    <p class="notice">※動画撮影やオンライン面接のマニュアルもご送付</p>
                </dd>
                <dt>STEP3</dt>
                <dd>企業登録画面から企業情報、PR動画のアップロード</dd>
            </dl>
            <footer>ご登録完了！</footer>
        </div>
    </section>
    <?php if(empty($clientAuthentication)): ?>
    <section class="main__content__qa" id="qa">
        <h2 class="headline headline--decolines">よくあるご質問</h2>
        <dl>
            <dt class="main__qa">基本的な利用の仕方について教えてください。</dt>
            <dd class="main__ans"><div><p><a href="<?php echo e(route('client.login')); ?>" class="link">ログインページ</a>から貴社のログインIDとログインパスワードをご入力のうえログインし、</p><p>《企業編集》より企業情報ほか動画や写真などをアップロードして企業ぺージを完成させてください。</p><p><a href="<?php echo e(route('client.student.list')); ?>" class="link">《学生検索》</a>から求職者のWeb履歴書を閲覧いただき、《メッセージを送る》ボタンから求職者にメッセージを送ることができます。</p><p>Web面接を実施する場合は、求職者とのメッセージから面接日時を決定し、</p><p>《Web面接を予約する》ボタンからWeb面接の予約を行ってください。</p><p>面接日時になりましたら、<a href="<?php echo e(route('client.video-interview.list')); ?>">Web面接学生一覧</a>よりWeb面接を実施する学生を選択し、ご利用可能ブラウザのチェックボックスにチェックを入れ、Web面接ルームに入室後、《接続》ボタンをタップして面接を開始してください。</p><div></dd>
            <dt class="main__qa">利用料金について知りたいのですが。</dt>
            <dd class="main__ans"><p>ご利用料金につきましては企業様の用途に基づいた複数のプランをご用意しておりますので、<a href="<?php echo e(route('client.contact')); ?>" class="link">お問い合わせフォーム</a>からお問い合わせいただければ担当者よりご連絡させていただきます。</p></dd>
            <dt class="main__qa">求職者からのメッセージ返信率をあげるにはどうすればよいでしょうか。</dt>
            <dd class="main__ans"><div><p>自社ページの完成度が高い企業様のメッセージ返信率が高い傾向にあります。</p><p>特に、学生に自社の強みを伝えるには動画によるPRが効果的です。</p><p>ログイン後、《企業編集》より企業情報のほか動画や写真などをアップロードし企業ページを完成させてください。</p></div></dd>
        </dl>
        <h2 class="headline main__qa--more" id="qa__list--open">質問をもっと見る</h2>
        <dl class="qa__list">
                <dt class="main__qa--more-qa">動画がアップロードできません。</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>アップロード可能な動画容量は1GBとなっております。</p><p>1GB以下に圧縮してアップロードを行ってください。</p><p>解決できない場合は、<a href="<?php echo e(route('client.contact')); ?>" class="link">お問い合わせフォーム</a>よりお問い合わせください。</p></div></div></dd>
                <dt class="main__qa--more-qa">動画を用意していないのですが。</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>LinkTは動画制作サービス(別途料金)も行っております。</p><p>制作をご希望の企業様は<a href="<?php echo e(route('client.contact')); ?>" class="link">お問い合わせフォーム</a>よりご連絡ください。</p></div></div></dd>
                <dt class="main__qa--more-qa">Web面接ができないのですが。</dt>
                <dd class="main__qa--more-ans">
                    <div class="ans__box">
                        <div>
                            <p>お使いのデバイスによって利用可能なブラウザを制限しております。</p><p>お手数ではございますが、現在ご利用のブラウザが当サービスでご利用可能かどうかのご確認をお願いいたします。</p>
                        </div>
                    </div>
                    <div id="browser_recommandation_container-qa">
                        <div id="browser_support-qa">
                            <p>※対応OSブラウザについて</p>
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
                        </div>
                    </div>
                </dd>
                <dt class="main__qa--more-qa">インターン選考のみの利用も可能でしょうか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>もちろん可能です。</p><p>インターン選考のみ、本選考のみ等、目的によってご利用の仕方をお決めください。</p></div></div></dd>
                <dt class="main__qa--more-qa">面接結果はどのように通知するのでしょうか。</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><p><a href="<?php echo e(route('client.message.list')); ?>" class="link">《メッセージ》</a>から通知する学生に結果のご連絡を行ってください。</p></div></dd>
            </dl>
        </dl>
    </section>
    <?php else: ?>
    <section class="main__content__qa" id="qa">
        <h2 class="headline headline--decolines">よくあるご質問</h2>
        <dl>
            <dt class="main__qa">基本的な利用の仕方について教えてください。</dt>
            <dd class="main__ans"><div><p><a href="<?php echo e(route('client.login')); ?>" class="link">ログインページ</a>から貴社のログインIDとログインパスワードをご入力のうえログインし、</p><p>《企業編集》より企業情報ほか動画や写真などをアップロードして企業ぺージを完成させてください。</p><p><a href="<?php echo e(route('client.student.list')); ?>" class="link">《学生検索》</a>から求職者のWeb履歴書を閲覧いただき、</p><p>《メッセージを送る》ボタンから求職者にメッセージを送ることができます。</p><p>Web面接を実施する場合は、求職者とのメッセージから面接日時を決定し、</p><p>《Web面接を予約する》ボタンからWeb面接の予約を行ってください。</p><p>面接日時になりましたら、<a href="<?php echo e(route('client.video-interview.list')); ?>">Web面接学生一覧</a>よりWeb面接を実施する学生を選択し、ご利用可能ブラウザのチェックボックスにチェックを入れ、Web面接ルームに入室後、《接続》ボタンをタップして面接を開始してください。</p><div></dd>
            <dt class="main__qa">求職者からのメッセージ返信率をあげるにはどうすればよいでしょうか。</dt>
            <dd class="main__ans"><div><p>自社ページの完成度が高い企業様のメッセージ返信率が高い傾向にあります。</p><p>特に、学生に自社の強みを伝えるには動画によるPRが効果的です。</p><p>ログイン後、《企業編集》より企業情報のほか動画や写真などをアップロードし企業ページを完成させてください。</p></div></dd>
            <dt class="main__qa">動画がアップロードできません。</dt>
            <dd class="main__ans"><div><p>アップロード可能な動画容量は1GBとなっております。</p><p>1GB以下に圧縮してアップロードを行ってください。</p><p>解決できない場合は、<a href="<?php echo e(route('client.contact')); ?>" class="link">お問い合わせフォーム</a>よりお問い合わせください。</p></div></dd>
        </dl>
        <h2 class="headline main__qa--more" id="qa__list--open">質問をもっと見る</h2>
        <dl class="qa__list">
                <dt class="main__qa--more-qa">動画を用意していないのですが。</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>LinkTは動画制作サービス(別途料金)も行っております。</p><p>制作をご希望の企業様は<a href="<?php echo e(route('client.contact')); ?>" class="link">お問い合わせフォーム</a>よりご連絡ください。</p></div></div></dd>
                <dt class="main__qa--more-qa">Web面接ができないのですが。</dt>
                <dd class="main__qa--more-ans">
                    <div class="ans__box">
                        <div>
                            <p>お使いのデバイスによって利用可能なブラウザを制限しております。</p><p>お手数ではございますが、現在ご利用のブラウザが当サービスでご利用可能かどうかのご確認をお願いいたします。</p>
                        </div>
                    </div>
                    <div id="browser_recommandation_container-qa">
                        <div id="browser_support-qa">
                            <p>※対応OSブラウザについて</p>
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
                        </div>
                    </div>
                </dd>
                <dt class="main__qa--more-qa">インターン選考のみの利用も可能でしょうか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>もちろん可能です。</p><p>インターン選考のみ、本選考のみ等、目的によってご利用の仕方をお決めください。</p></div></div></dd>
                <dt class="main__qa--more-qa">面接結果はどのように通知するのでしょうか。</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><p><a href="<?php echo e(route('client.message.list')); ?>" class="link">《メッセージ》</a>から通知する学生に結果のご連絡を行ってください。</p></div></dd>
            </dl>
        </dl>
    </section>
    <?php endif; ?>
    <section class="main__device">
        <h2 class="headline headline--decolines">対応OS<br>ブラウザについて</h2>
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
    </section>
    <nav class="navSp footerNav">
        <a href="<?php echo e(route('client.contact')); ?>">企業会員登録</a>
        <a href="<?php echo e(route('client.static.use')); ?>">使い方はこちら</a>
    </nav>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>