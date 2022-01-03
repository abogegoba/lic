@extends('client.common.root')

@section('description','ニュース詳細：ニュース詳細表示')

@section('title','infit、サービスの海外展開に向けて株式会社トレードメディアジャパン（ＭＲＴ宮崎放送グループ）とパートナー契約を締結　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="/assets/css/news/detail/index.css">
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li><a href="{{route('client.news.list')}}">ニュース</a></li>
            <li>ニュース詳細</li>
        </ul>
    </nav>
@stop

@section('content')
    <div class="main__content content__news__detail">
        <h2 class="main__content__headline">infit、サービスの海外展開に向けて株式会社トレードメディアジャパン（ＭＲＴ宮崎放送グループ）とパートナー契約を締結</h2>
        <div class="news__detail__header">
            <span class="news__label">ニュースリリース</span>
            <span class="news__date">2019/10/24（木）</span>
        </div>

        <div class="news__detail__content">
            <p>
                　株式会社 infit（本社：東京都渋谷区、代表取締役：後藤剛志　以下、当社）は、当社の運営するSNS型就職支援プラットフォーム『LinkT（リンクト）』（以下、“LinkT”）の、今後の海外向けサービスの展開に向けて、台湾をはじめとするアジア圏域で地域商社事業を行う株式会社トレードメディアジャパン（本社：宮崎県宮崎市、代表取締役社長：高田智康　以下、トレードメディアジャパン）とパートナー契約を締結いたしましたのでお知らせいたします。
                <span class="news__logo__inline">
                            <img src="{{asset('img/partner/logo/mbg-trade-media-japan01.png')}}" alt="株式会社トレードメディアジャパン" class="news__logo">
                            <img src="{{asset('img/news/linkt.png')}}" alt="次世代型就活サイト：LinkT" class="news__logo">
                        </span>
            </p>
            <p>
                　LinkTは、企業と人材がオンライン上で1:1のマッチングを行うことが可能なプラットフォームで、双方の検索から面接まで一貫して行えることで採用の自由化を実現するサービスです。<br>
                　今回のパートナー契約により、LinkTが行う今後の海外サービス展開に向けて、台湾を中心としたアジア圏域にネットワークを構築するトレードメディアジャパンと業務提携を行うことで地域企業の海外人材獲得による地域活性化に寄与します。
            </p>
            <p>
                株式会社トレードメディアジャパンについて<br>
                <br>
                昨年7月にＭＲＴ宮崎放送の新たなグループ会社として設立され、宮崎を中心に台湾をはじめとするアジア圏域と人・もの・企業をつなぎ、プロモーションから販売までをトータルプロデュースする。<br>
                現在は台湾支社を起点にテレビ局やネット会社と提携し、<br>
                番組制作・放送やWEBプロモーションを展開しながら商流を確立し、地域経済に貢献する地産外商の役割を担う。
            </p>
            <p>
                株式会社トレードメディアジャパン<br>
                代表取締役社長　高田氏のコメント<br>
                <br>
                地域と共に成長し、地域の未来を創造する。その地産外商の実現に不可欠なのは人材です。<br>
                今回、トレードメディアジャパンでは台湾支社を中心としたネットワークによりアジア圏域の人材獲得の一役を担い、株式会社 infit様と共にさらなる海外展開（地産外商）や投資の実現をサポートさせていただきます。
            </p>
            <p>
                会社名：株式会社トレードメディアジャパン<br>
                設立：2018年7月2日<br>
                所在地：宮崎市橘通西4-1-32　MRTテラス５F<br>
                代表者：代表取締役社長　高田智康<br>
                URL：<a href="https://www.tm-japan.jp/" target="_blank">https://www.tm-japan.jp</a>
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

        <nav class="navBk fontSize--small"><a href="{{route('client.news.list')}}">ニュース一覧</a></nav>

    </div>
@stop