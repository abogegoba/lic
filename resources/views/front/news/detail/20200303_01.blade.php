@extends('front.common.root')

@section('description','ニュース詳細：ニュース詳細表示')

@section('title','LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨　｜　次世代型就活サイト　LinkT')

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
        <h2 class="main__content__headline">LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨</h2>
        <div class="news__detail__header">
            <span class="news__label">ニュースリリース</span>
            <span class="news__date">2020/03/03（火）</span>
        </div>

        <div class="news__detail__content">
            <p>
                株式会社infit（本社：東京都渋谷区 代表取締役　後藤剛志　以下、当社）は、
                パートナー企業である長崎放送株式会社（本社：長崎県長崎市　代表取締役社長　東晋）と連携し、当社の運営する新卒採用プラットフォーム『LinkT(リンクト)』
                (以下、”LinkT”)の利用による各企業の採用活動のリモート化を推奨いたします。
            </p>
            <p>
                LinkTは、Web面接機能を搭載したSNS型の採用プラットフォームで、
                オンライン上で企業と学生双方の検索やコンタクト、面接まで一貫して
                行うことができるサービスです。
                昨年9月のサービス開始以来、企業約100社の新卒採用のリモート化を推奨して
                きました。
            </p>
            <p>
                転換期を迎える昨今の新卒採用市場では、活動の早期化や通年化、
                デジタル化が顕著で、PCやスマホを利用しオンライン上で学生と
                コミュニケーションを図る企業が増加しています。
                特に、採用に多大なコストをかけることが難しく、学生の認知や接触機会の少ない
                地方企業や中小企業、ベンチャー企業などは、
                LinkTを利用することで企業規模に左右されないフラットな
                採用活動を実現することができます。
            </p>
            <p>
                現在、新型コロナウイルス感染拡大により各地での採用イベント中止が相次ぐ中、
                求人企業と求職者の安全を担保した良質な採用活動の提供が急務となっております。
                LinkTは遠隔で採用活動が行えるサービスの提供により「人込みを回避した採用活動」
                のサポートをさせていただくとともに、今後とも全国各地の企業の採用のリモート化の普及に寄与してまいります。
            </p>
            <p>
                <b>長崎放送株式会社　会社概要</b><br>
                会社名：長崎放送株式会社<br>
                設立：1952年9月12日<br>
                所在地：長崎県長崎市上町1番35号<br>
                代表者：代表取締役　東晋<br>
                URL：<a href="https://www.nbc-nagasaki.co.jp/" target="_blank">https://www.nbc-nagasaki.co.jp/</a>
            </p>
            <p>
                <b>株式会社infit　会社概要</b><br>
                会社名：　株式会社infit<br>
                設立　：　2019年3月5日<br>
                所在地：　東京都渋谷区恵比寿西2-2-8 えびす第2ビル2F<br>
                代表者：　代表取締役 後藤剛志<br>
                URL：<a href="https://in-fit.co.jp/" target="_blank">https://in-fit.co.jp/</a>
            </p>

            <p>
                本リリースに関するお問い合わせ<br>
                株式会社infit お問い合わせ窓口<br>
                E-mail： <a href="mailto:contact@in-fit.co.jp" target="_top">contact@in-fit.co.jp</a>
            </p>
            <p class="align--right">
                以上
            </p>
        </div>

        <nav class="navBk fontSize--small"><a href="{{route('front.news.list')}}">ニュース一覧</a></nav>

    </div>
@stop
