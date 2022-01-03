@extends('client.common.root')

@section('description','会員登録：基本情報入力')

@section('title','運営会社　｜　次世代型就活サイト　LinkT')

@section('css')
    <link rel="stylesheet" href="{{asset('css/company/common.css')}}">
@stop

@section('content')
    <div class="main__content">
        <section>
            <h2 class="main__content__headline">運営会社</h2>
            <dl class="basic">
                <dt>社名</dt>
                <dd>
                    株式会社infit<br>
                    infit, Inc.
                </dd>
                <dt>本社所在地</dt>
                <dd>
                    〒150-0021<br>
                    東京都渋谷区恵比寿西2-2-8 えびす第2ビル2F<br>
                    Tel：03-6427-0081（代表）
                </dd>
                <dt>代表者</dt>
                <dd>
                    代表取締役　後藤　剛志
                </dd>
                <dt>設立</dt>
                <dd>
                    2019年3月5日
                </dd>
                <dt>事業内容</dt>
                <dd>
                    メディア運営事業<br>
                    Webサービス開発<br>
                    人材育成事業
                </dd>
            </dl>
        </section>
    </div>
@stop

