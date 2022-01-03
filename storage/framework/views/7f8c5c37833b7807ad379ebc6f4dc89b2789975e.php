

<?php $__env->startSection('description','ニュース詳細：ニュース詳細表示'); ?>

<?php $__env->startSection('title','株式会社電通とパートナー契約を締結　｜　次世代型就活サイト　LinkT'); ?>

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
        <h2 class="main__content__headline">株式会社電通とパートナー契約を締結</h2>
        <div class="news__detail__header">
            <span class="news__label">ニュースリリース</span>
            <span class="news__date">2019/08/27（火）</span>
        </div>

        <div class="news__detail__content">
            <p>
                　株式会社infit（本社：東京都渋谷区、代表取締役：後藤剛志　以下、当社）は、企業と学生の1:1のマッチングを可能にするSNS型就職支援プラットフォーム『LinkT(リンクト)』（以下、“LinkT”）のサービス開始にあたり、株式会社電通（本社：東京都港区、代表取締役社長：山本敏博）との販売代理パートナー契約が成立したことをお知らせいたします。<br>
                　今回成立した販売代理パートナー契約により、当社と電通は“LinkT”の全国での顧客開拓について協業していきます。具体的には、電通の取引先企業に“LinkT”サービスを直接紹介するとともに、各地の有力メディアを通じ地域の有力企業に対して当サービスをプロモートしていく予定です。<br>
                　当社は“LinkT”の展開を通じて地方に所在する地域の有力企業・新興企業が感じている人材不足の解消に貢献します。同時に就職先を探す学生に対しても企業と本人の志向や得意分野のマッチングを通じて、地域を問わずより働き甲斐がある職場を見つけられること、それによって将来にわたり一人一人の志向に合ったライフスタイルの実現に貢献できると考えています。
            </p>
            <p>
                ＜株式会社電通　会社概要＞<br>
                会社名：株式会社 電通<br>
                設立：1901年7月1日<br>
                所在地：東京都港区東新橋1-8-1<br>
                代表者：代表取締役社長執行役員 山本敏博<br>
                URL：<a href="http://www.dentsu.co.jp/" target="_blank">http://www.dentsu.co.jp/</a>
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

        <nav class="navBk fontSize--small"><a href="<?php echo e(route('client.news.list')); ?>">ニュース一覧</a></nav>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>