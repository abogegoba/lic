@extends('front.common.root')

@section('description','')

@section('title','ご利用の流れ｜次世代の就活ならLinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/use/about/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/use/about/index_custom.css')}}">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li>ご利用の流れ</li>
        </ul>
    </nav>
@stop

@section('content')
    <section class="main__catch">
        <picture>
            <source media="(max-width: 767px)" srcset={{asset('img/use/about/main_howto_student-sp.jpg')}}>
            <img src="{{asset('img/use/about/main_howto_student-pc.jpg')}}" alt="ご利用の流れ" class="">
        </picture>
    </section>
    <section class="main__content-use">
        <section class="content__block">
            <div>
                <h2><img src="{{asset('img/use/about/ttl01.png')}}" alt="まずは会員登録"></h2>
                <p>自己PR動画や履歴書を<br class="pc">アップロードするだけでエントリー完了！</p>
                <p>＜ハッシュタグ登録やインスタフォロワー数なども登録可能＞</p>
            </div>
            <picture>
                <source media="(max-width: 767px)" srcset={{asset('img/use/about/img_student01-sp.jpg')}}>
                <img src="{{asset('img/use/about/img_student01-pc.jpg')}}" alt="">
            </picture>
        </section>
        <section class="content__block">
            <picture>
                <source media="(max-width: 767px)" srcset={{asset('img/use/about/img_student02-sp.jpg')}}>
                <img src="{{asset('img/use/about/img_student02-pc.jpg')}}" alt="">
            </picture>
            <div>
                <h2><img src="{{asset('img/use/about/ttl02.png')}}" alt="気になる企業を検索"></h2>
                <p>登録が完了したら、<br>さっそく自分が気になる企業を検索してみよう！</p>
                <p>＜企業のPR動画を見て職場の雰囲気や人、サービスを知ろう＞</p>
            </div>
        </section>
        <section class="content__block">
            <div>
                <h2><img src="{{asset('img/use/about/ttl03.png')}}" alt="人事担当者へメッセージ"></h2>
                <p>気になる企業にメッセージを送ってみよう！<br>人事担当者があなたの自己PR動画や履歴書を見て興味を持ってくれたら面接のチャンス！</p>
            </div>
            <picture>
                <source media="(max-width: 767px)" srcset={{asset('img/use/about/img_student03-sp.jpg')}}>
                <img src="{{asset('img/use/about/img_student03-pc.jpg')}}" alt="">
            </picture>
        </section>
        <section class="content__block">
            <picture>
                <source media="(max-width: 767px)" srcset={{asset('img/use/about/img_student04-sp.jpg')}}>
                <img src="{{asset('img/use/about/img_student04-pc.jpg')}}" alt="">
            </picture>
            <div>
                <h2><img src="{{asset('img/use/about/ttl04.png')}}" alt="面接予約"></h2>
                <p>メッセージ機能から<br class="sp">面接予約が可能！</p>
                <p>＜面接予約カレンダーでスケジュール管理も確実＞</p>
            </div>
        </section>
        <section class="content__block">
            <div>
                <h2><img src="{{asset('img/use/about/ttl05.png')}}" alt="面接実施"></h2>
                <p>人事担当者から発行されるURLから入室しオンライン面接開始</p>
                <p>＜面接当日のメール通知もあり＞</p>
            </div>
            <picture>
                <source media="(max-width: 767px)" srcset={{asset('img/use/about/img_student05-sp.jpg')}}>
                <img src="{{asset('img/use/about/img_student05-pc.jpg')}}" alt="">
            </picture>
        </section>
        <section class="content__block">
            <picture>
                <source media="(max-width: 767px)" srcset={{asset('img/use/about/img_student06-sp.jpg')}}>
                <img src="{{asset('img/use/about/img_student06-pc.jpg')}}" alt="">
            </picture>
            <div>
                <h2><img src="{{asset('img/use/about/ttl06.png')}}" alt="面接結果の受け取り"></h2>
                <p>メッセージで面接の<br class="sp">合否結果を受け取れます。</p>
                <p>＜人事担当者から高評価を受けたら、一気に内定確度がアップ＞</p>
            </div>
        </section>
    </section>
    @if(empty($memberAuthentication))
    <nav class="footerNav navSp fontSize--small">
        <ul>
            <li><a href="{{route('front.member.login')}}">ログイン</a></li>
            <li><a href="{{route('front.static.select_entry')}}">会員登録</a></li>
        </ul>
    </nav>
    @endif
@stop
