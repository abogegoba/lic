@extends('front.common.root')

@section('description','ニュース詳細：ニュース詳細表示')

@section('title','長崎放送株式会社とパートナー契約を締結　｜　次世代型就活サイト　LinkT')

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
        <h2 class="main__content__headline">長崎放送株式会社とパートナー契約を締結</h2>
        <div class="news__detail__header">
            <span class="news__label">ニュースリリース</span>
            <span class="news__date">2019/09/12（木）</span>
        </div>

        <div class="news__detail__content">
            <p>
                　株式会社infit（本社：東京都渋谷区、代表取締役：後藤剛志　以下、当社）は、当社の運営する次世代型就職支援プラットフォーム『LinkT（リンクト）』（以下、"LinkT"）と長崎放送株式会社（本社：長崎県長崎市、代表取締役社長：東晋　以下、長崎放送）の販売代理パートナー契約が成立したことをお知らせいたします。<br>
                　今回成立した販売代理パートナー契約により、当社と長崎放送は、長崎県を中心とした"LinkT"の顧客開拓について協業していきます。<br>
                　当社は、"LinkT"の各地への展開を通じて地域に所在する有力企業、新興企業が地域での就職を希望または興味をもつ学生に対して、動画を中心とした自社PRにより認知拡大を成功させ、遠方からでもコストをかけずにコンタクトをとることが可能になることで各地域の雇用創出の実現に貢献できると考えています。
            </p>
            <p>
                ＜長崎放送株式会社　会社概要＞
                <img src="{{asset('img/partner/logo/nbc-nagasaki01.png')}}" alt="長崎放送株式会社" class="news__logo">
                会社名：長崎放送株式会社<br>
                設立：1952年9月12日<br>
                所在地：長崎県長崎市上町1番35号<br>
                代表者：代表取締役 東晋<br>
                URL：<a href="https://www.nbc-nagasaki.co.jp/" target="_blank">https://www.nbc-nagasaki.co.jp/</a>
            </p>
            <p>
                本リリースに関するお問い合わせ<br>
                株式会社infit お問い合わせ窓口<br>
                E-mail : info@in-fit.co.jp
            </p>
            <p class="align--right">
                以上
            </p>
        </div>

        <nav class="navBk fontSize--small"><a href="{{route('front.news.list')}}">ニュース一覧</a></nav>

    </div>
@stop
