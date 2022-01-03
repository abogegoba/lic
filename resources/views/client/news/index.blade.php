@extends('client.common.root')

@section('description','ニュース一覧：ニュース一覧表示')

@section('title','ニュース　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/news/index.css')}}">
    <style>
        .b_background{
            background: #000;
            border-radius: 10px 10px 0px 0px;
        }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            // ニュースカテゴリ絞り込み
            'use strict';
            var $filter = $('.news__tag [data-filter]'),
                $list = $('.news__list [data-list]');

            $filter.on('click', function (e) {
                e.preventDefault();
                var $this = $(this);

                $filter.removeClass('active');
                $this.addClass('active');

                var $filterList = $this.attr('data-filter');

                if ($filterList == 'all') {
                    $list.removeClass('animated')
                        .fadeOut().finish().promise().done(function () {
                        $list.each(function (i) {
                            if($(this).attr('data-list') != 'tag03'){
                                $(this).addClass('animated').delay((i++) * 100).fadeIn();
                            }
                        });
                    });
                } else {
                    $list.removeClass('animated')
                        .fadeOut().finish().promise().done(function () {
                        $list.filter('[data-list = "' + $filterList + '"]').each(function (i) {
                            $(this).addClass('animated').delay((i++) * 100).fadeIn();
                        });
                    });
                }
            });

            $(window).on('load', function () {
                $list.removeClass('animated')
                    .fadeOut().finish().promise().done(function () {
                    $list.each(function (i) {
                        if($(this).attr('data-list') != 'tag03'){
                            $(this).addClass('animated').delay((i++) * 100).fadeIn();
                        }
                    });
                });
            });
        });
    </script>
@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('client.top')}}">LINKT（ビジネス版） TOP</a></li>
            <li>ニュース</li>
        </ul>
    </nav>
@stop

@section('content')
    <div class="main__content content__news content__term">
        <h2 class="main__content__headline">ニュース</h2>
        <div class="news__tag">
            <button class="all active" data-filter="all">全て</button>
            <button class="tag01" data-filter="tag01">リリース</button>
            <button class="tag02" data-filter="tag02">サービス</button>
            <button class="tag03 green_button" data-filter="tag03">メディア</button>
        </div>

        <div class="news__list">
            <!--new-->
            <div class="news__item" data-list="tag01">
                <a href="{{route('client.news.detail_4')}}" rel="noopener">
                    <div class="news__item__img img--logo">
                        <img src="{{asset('img/partner/logo/20200303-02_thumb.jpg')}}" alt="LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施">
                    </div>
                    <div class="news__item__title">
                        LinkT(リンクト)、新型コロナウイルス感染拡大による新卒採用イベント中止に伴い採用動画無料制作キャンペーン実施
                    </div>
                    <div class="news__item__footer">
                        <span class="news__label news__label__blue">ニュースリリース</span>
                        <span class="news__date">2020/03/03（火）</span>
                    </div>
                </a>
            </div>
            <div class="news__item" data-list="tag01">
                <a href="{{route('client.news.detail_5')}}" rel="noopener">
                    <div class="news__item__img img--logo">
                        <img src="{{asset('img/partner/logo/20200303-01_thumb.png')}}" alt="LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨">
                    </div>
                    <div class="news__item__title">
                        LinkT(リンクト)、ローカル放送局の長崎放送株式会社と連携し新卒採用のリモート化を推奨
                    </div>
                    <div class="news__item__footer">
                        <span class="news__label news__label__blue">ニュースリリース</span>
                        <span class="news__date">2020/03/03（火）</span>
                    </div>
                </a>
            </div>
            <div class="news__item" data-list="tag01">
                <a href="{{route('client.news.detail_6')}}" rel="noopener">
                    <div class="news__item__img img--logo">
                        <img src="{{asset('img/partner/logo/20200303-00_thumb.jpg')}}" alt="LinkT、台湾人大学生の登録を開始">
                    </div>
                    <div class="news__item__title">
                        LinkT、台湾人大学生の登録を開始
                    </div>
                    <div class="news__item__footer">
                        <span class="news__label news__label__blue">ニュースリリース</span>
                        <span class="news__date">2020/03/03（火）</span>
                    </div>
                </a>
            </div>
            <!--old-->
            <div class="news__item" data-list="tag02">
                <a href="{{route('client.lp.touei-housing-corporation')}}" target="_blank" rel="noopener">
                    <div class="news__item__img img--logo">
                        <img src="{{asset('img/partner/logo/touei-housing-corporation01.png')}}" alt="東栄住宅×LinkT FUKUOKA STREET PARTY でコラボブース出展">
                    </div>
                    <div class="news__item__title">
                        東栄住宅×LinkT FUKUOKA STREET PARTY でコラボブース出展
                    </div>
                    <div class="news__item__footer">
                        <span class="news__label news__label__blue">サービスニュース</span>
                        <span class="news__date">2019/11/12（火）</span>
                    </div>
                </a>
            </div>

            <div class="news__item" data-list="tag01">
                <a href="{{route('client.news.detail_3')}}">
                    <div class="news__item__img img--logo">
                        <img src="{{asset('img/partner/logo/mbg-trade-media-japan01.png')}}" alt="株式会社トレードメディアジャパンとパートナー契約を締結">
                    </div>
                    <div class="news__item__title">
                        infit、サービスの海外展開に向けて株式会社トレードメディアジャパン（ＭＲＴ宮崎放送グループ）とパートナー契約を締結
                    </div>
                    <div class="news__item__footer">
                        <span class="news__label news__label__blue">ニュースリリース</span>
                        <span class="news__date">2019/10/24（木）</span>
                    </div>
                </a>
            </div>

            <div class="news__item" data-list="tag01">
                <a href="{{route('client.news.detail_2')}}">
                    <div class="news__item__img img--logo">
                        <img src="{{asset('img/partner/logo/nbc-nagasaki01.png')}}" alt="長崎放送株式会社とパートナー契約を締結">
                    </div>
                    <div class="news__item__title">
                        長崎放送株式会社とパートナー契約を締結
                    </div>
                    <div class="news__item__footer">
                        <span class="news__label news__label__blue">ニュースリリース</span>
                        <span class="news__date">2019/09/12（木）</span>
                    </div>
                </a>
            </div>

            <div class="news__item" data-list="tag01">
                <a href="{{route('client.news.detail_1')}}">
                    <div class="news__item__img img--logo">
                        <img src="{{asset('img/partner/logo/dentsu01.png')}}" alt="株式会社電通とパートナー契約を締結">
                    </div>
                    <div class="news__item__title">
                        株式会社電通とパートナー契約を締結
                    </div>
                    <div class="news__item__footer">
                        <span class="news__label news__label__blue">ニュースリリース</span>
                        <span class="news__date">2019/08/27（火）</span>
                    </div>
                </a>
            </div>

            <div class="news__item" data-list="tag01">

                <div class="news__item__img img--logo">
                    <img src="{{asset('img/partner/logo/gogaku01.png')}}" alt="Gogaku株式会社とパートナー契約を締結">
                </div>
                <div class="news__item__title">
                    Gogaku株式会社とパートナー契約を締結
                </div>
                <div class="news__item__footer">
                    <span class="news__label news__label__blue">ニュースリリース</span>
                    <span class="news__date">2019/08/27（火）</span>
                </div>

            </div>
            <!--media-->
            <div class="news__item" data-list="tag03">
                <div class="news__item__img img--logo b_background">
                    <img src="{{asset('img/client/media/1.png')}}" alt="テレビ山口【tys情報PickUp】 に取り上げられました。">
                </div>
                <div class="news__item__title">
                    テレビ山口【tys情報PickUp】 に取り上げられました。
                </div>
                <div class="news__item__footer">
                    <span class="news__label news__label__green">メディア</span>
                    <span class="news__date">2019/09/13（金）</span>
                </div>
            </div>
            <div class="news__item" data-list="tag03">
                <div class="news__item__img img--logo">
                    <img src="{{asset('img/client/media/2_2x.png')}}" alt="大分放送【アレ・コレBOX】 に取り上げられました。">
                </div>
                <div class="news__item__title">
                    大分放送【アレ・コレBOX】 に取り上げられました。
                </div>
                <div class="news__item__footer">
                    <span class="news__label news__label__green">メディア</span>
                    <span class="news__date">2019/10/10 (木)</span>
                </div>
            </div>
            <div class="news__item" data-list="tag03">
                <div class="news__item__img img--logo">
                    <img src="{{asset('img/client/media/3.jpg')}}" alt="中国放送【ランキンLand！】 に取り上げられました。">
                </div>
                <div class="news__item__title">
                    中国放送【ランキンLand！】 に取り上げられました。
                </div>
                <div class="news__item__footer">
                    <span class="news__label news__label__green">メディア</span>
                    <span class="news__date">2019/12/06 (金)</span>
                </div>
            </div>
            <div class="news__item" data-list="tag03">
                <div class="news__item__img img--logo">
                    <img src="{{asset('img/client/media/4_2x.png')}}" alt="長崎放送【あっぷる】 に取り上げられました。">
                </div>
                <div class="news__item__title">
                    長崎放送【あっぷる】 に取り上げられました。
                </div>
                <div class="news__item__footer">
                    <span class="news__label news__label__green">メディア</span>
                    <span class="news__date">2019/09/04 (水)</span>
                </div>
            </div>
            <div class="news__item" data-list="tag03">
                <div class="news__item__img img--logo">
                    <img src="{{asset('img/client/media/5_2x.png')}}" alt="長野朝日放送【今ドキ！昼ドキッ】 に取り上げられました。">
                </div>
                <div class="news__item__title">
                    長野朝日放送【今ドキ！昼ドキッ】 に取り上げられました。
                </div>
                <div class="news__item__footer">
                    <span class="news__label news__label__green">メディア</span>
                    <span class="news__date">2019/09/16 (月)</span>
                </div>
            </div>

        </div>
    </div>
@stop
