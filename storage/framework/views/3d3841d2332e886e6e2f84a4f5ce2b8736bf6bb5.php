<?php $__env->startSection('description','ニュース詳細：ニュース詳細表示'); ?>

<?php $__env->startSection('title','LinkT、台湾人大学生の登録を開始　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/assets/css/news/detail/index.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li><a href="<?php echo e(route('client.news.list')); ?>">ニュース</a></li>
            <li>ニュース詳細</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main__content content__news__detail">
        <h2 class="main__content__headline">LinkT、台湾人大学生の登録を開始</h2>
        <div class="news__detail__header">
            <span class="news__label">ニュースリリース</span>
            <span class="news__date">2020/03/03（火）</span>
        </div>

        <div class="news__detail__content">
            <p>
                株式会社infit（本社：東京都渋谷区 代表取締役　後藤剛志　以下、当社）は、
                パートナー企業である株式会社トレードメディアジャパン（本社：宮崎県宮崎市　代表取締役社長　高田智康）と連携し、当社の運営する採用プラットフォーム『LinkT(リンクト)』の台湾人大学生の登録を開始いたしました。
            </p>
            <p>
                LinkTは、Web面接機能を搭載したSNS型の採用プラットフォームで、
                オンライン上で企業と学生双方の検索やコンタクト、面接まで一貫して
                行うことができるサービスです。
                日本での就職を希望する台湾人大学生とグローバル人材を採用する企業
                双方のリモートによるマッチングを可能にすることで、
                現地に足を運び活動するコストや労力の問題による出会いの機会損失を防ぎ、
                人口減少社会という新たな課題に直面する日本の労働力不足に歯止めをかける取り組みを行います。
            </p>
            <p>
                当社は今後、台湾だけでなく各国の優秀な人材と日本企業がオンライン上で
                採用活動を行えるサービスの開発に取り組んでまいります。
            </p>
            <p>
                <b>株式会社トレードメディアジャパンについて</b><br>
                会社名：　株式会社トレードメディアジャパン<br>
                設立　：　2018年7月2日<br>
                所在地：　宮崎市橘通西4-1-32  MRTテラス5F<br>
                代表者：　代表取締役社長　高田智康<br>
                URL：<a href="https://www.tm-japan.jp/" target="_blank">https://www.tm-japan.jp/</a>
            </p>
            <p>
                <b>株式会社infitについて</b><br>
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

        <nav class="navBk fontSize--small"><a href="<?php echo e(route('client.news.list')); ?>">ニュース一覧</a></nav>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>