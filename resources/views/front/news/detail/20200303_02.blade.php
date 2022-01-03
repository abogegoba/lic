@extends('front.common.root')

@section('description','ニュース詳細：ニュース詳細表示')

@section('title','LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="/assets/css/news/detail/index.css">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li><a href="{{route('front.news.list')}}">ニュース</a></li>
            <li>ニュース詳細</li>
        </ul>
    </nav>
@stop

@section('content')
    <div class="main__content content__news__detail">
        <h2 class="main__content__headline">LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施
        </h2>
        <div class="news__detail__header">
            <span class="news__label">ニュースリリース</span>
            <span class="news__date">2020/03/03（火）</span>
        </div>

        <div class="news__detail__content">
            <p>
                株式会社infit（本社：東京都渋谷区 代表取締役　後藤剛志　以下、当社）は、新型コロナウイルス感染拡大による各地の新卒採用イベント中止に伴い、新卒採用動画の無料制作キャンペーンを実施いたします。
            </p>
            <p>
                <b>LinkT採用動画無料制作キャンペーンについて</b><br>
                LinkTは、動画を中心とした求人情報ページを作成・編集し、サイト内で学生との1:1のコミュニケーションやWeb面接が可能な採用プラットフォームです。
                <br>
                新型コロナウイルス感染拡大に伴う新卒採用イベントの中止により学生との貴重な接触機会を損失された各企業様へ向け、自社PRに欠かせない新卒向け採用動画を当キャンペーン期間内につき先着50社様限定で無料制作させていただきます。
            </p>
            <p>
                <b>キャンペーン実施概要</b>
                <br>
                期間    ：3/4(水)～4/30(木)<br>
                納品期間：撮影から3営業日以内<br>
                実施条件：先着50社様<br>
                LinkTへの12か月間ご利用(月額85,000円)<br>
                ※複数プランがございます<br>
                ※その他詳細情報につきましては下記よりお問い合わせください。<br>

            </p>
            <p>
                <b>本キャンペーンに関するお問い合わせ先</b><br>
                LinkTサポートセンター　: <a href="mailto:support＠in-fit.co.jp" target="_top">support＠in-fit.co.jp</a><br>
            </p>
            <p>
                <b>株式会社infit 会社概要</b><br>
                会社名：　株式会社infit<br>
                設立　：　2019年3月5日<br>
                所在地：　東京都渋谷区恵比寿西2-2-8 えびす第2ビル2F<br>
                代表者：　代表取締役 後藤剛志<br>
                URL：<a href="https://in-fit.co.jp/" target="_blank">https://in-fit.co.jp/</a>
            </p>

            <p>
                本リリースに関するお問い合わせ<br>
                株式会社infit お問い合わせ窓口<br>
                E-mail : <a href="mailto:contact@in-fit.co.jp" target="_top">contact@in-fit.co.jp</a>
            </p>
            <p class="align--right">
                以上
            </p>
        </div>

        <nav class="navBk fontSize--small"><a href="{{route('front.news.list')}}">ニュース一覧</a></nav>

    </div>
@stop
