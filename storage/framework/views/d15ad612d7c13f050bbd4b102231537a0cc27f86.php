<?php $__env->startSection('title','パートナー企業様 ご紹介　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/partner/index.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li>パートナー企業様 ご紹介</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main__content content__partner content__term">
        <h2 class="main__content__headline">パートナー企業様 ご紹介</h2>
        <div class="partner__lead">
            <p>
                LinkTのパートナー企業様をご紹介いたします。
            </p>
        </div>

        <div class="partner__content">
            <p class="partner__logo">
                <img src="<?php echo e(asset('img/partner/logo/mbg-trade-media-japan01.png')); ?>" alt="株式会社トレードメディアジャパン">
            </p>
            <div class="partner__list">
                <dl>
                    <dt>会社名</dt>
                    <dd>株式会社トレードメディアジャパン</dd>
                </dl>
                <dl>
                    <dt>設立</dt>
                    <dd>2018年7月2日</dd>
                </dl>
                <dl>
                    <dt>所在地</dt>
                    <dd>宮崎県宮崎市橘通西4-1-32 MRTテラス５F</dd>
                </dl>
                <dl>
                    <dt>代表者</dt>
                    <dd>代表取締役社長 高田 智康</dd>
                </dl>
                <dl>
                    <dt>URL</dt>
                    <dd>
                        <a href="https://www.tm-japan.jp/" target="_blank">https://www.tm-japan.jp/</a>
                    </dd>
                </dl>
            </div>
            <p>
                <a href="<?php echo e(route('client.news.detail_3')); ?>">infitと株式会社トレードメディアジャパンのパートナー契約締結のリリースはこちら</a>
            </p>
        </div>

        <div class="partner__content">
            <p class="partner__logo">
                <img src="<?php echo e(asset('img/partner/logo/nbc-nagasaki01.png')); ?>" alt="長崎放送株式会社">
            </p>
            <div class="partner__list">
                <dl>
                    <dt>会社名</dt>
                    <dd>長崎放送株式会社</dd>
                </dl>
                <dl>
                    <dt>設立</dt>
                    <dd>1952年9月12日</dd>
                </dl>
                <dl>
                    <dt>所在地</dt>
                    <dd>長崎県長崎市上町1番35号</dd>
                </dl>
                <dl>
                    <dt>代表者</dt>
                    <dd>代表取締役 東晋</dd>
                </dl>
                <dl>
                    <dt>URL</dt>
                    <dd>
                        <a href="https://www.nbc-nagasaki.co.jp/" target="_blank">https://www.nbc-nagasaki.co.jp/</a>
                    </dd>
                </dl>
            </div>
            <p>
                <a href="<?php echo e(route('client.news.detail_2')); ?>">infitと長崎放送のパートナー契約締結のリリースはこちら</a>
            </p>
        </div>

        <div class="partner__content">
            <p class="partner__logo">
                <img src="<?php echo e(asset('img/partner/logo/dentsu01.png')); ?>" alt="株式会社 電通">
            </p>
            <div class="partner__list">
                <dl>
                    <dt>会社名</dt>
                    <dd>株式会社 電通</dd>
                </dl>
                <dl>
                    <dt>所在地</dt>
                    <dd>東京都港区東新橋1-8-1</dd>
                </dl>
                <dl>
                    <dt>設立</dt>
                    <dd>1901年7月1日</dd>
                </dl>
                <dl>
                    <dt>代表者</dt>
                    <dd>代表取締役社長執行役員 山本 敏博</dd>
                </dl>
                <dl>
                    <dt>URL</dt>
                    <dd>
                        <a href="http://www.dentsu.co.jp/" target="_blank">http://www.dentsu.co.jp/</a>
                    </dd>
                </dl>
            </div>
            <p>
                <a href="<?php echo e(route('client.news.detail_1')); ?>">infitと電通のパートナー契約締結のリリースはこちら</a>
            </p>
        </div>

        <div class="partner__content">
            <p class="partner__logo">
                <img src="<?php echo e(asset('img/partner/logo/gogaku01.png')); ?>" alt="Gogaku株式会社">
            </p>
            <div class="partner__list">
                <dl>
                    <dt>会社名</dt>
                    <dd>Gogaku株式会社</dd>
                </dl>
                <dl>
                    <dt>設立</dt>
                    <dd>平成30年9月3日</dd>
                </dl>
                <dl>
                    <dt>本社所在地</dt>
                    <dd>大阪市都島区東野田町1-21-20 黒崎ビル3F</dd>
                </dl>
                <dl>
                    <dt>代表者</dt>
                    <dd>山岡 啓一朗</dd>
                </dl>
                <dl>
                    <dt>事業内容</dt>
                    <dd>語学スクール運営、HSK中国語検定試験、ホテル運営、留学、その他</dd>
                </dl>
                <dl>
                    <dt>TEL</dt>
                    <dd>06-7710-6882</dd>
                </dl>
                <dl>
                    <dt>Mail</dt>
                    <dd>info@cls-gogaku.com</dd>
                </dl>
                <dl>
                    <dt>URL</dt>
                    <dd>
                        中国語スクール　<a href="https://www.cls-chinese.com/" target="_blank">https://www.cls-chinese.com/</a><br>
                        日本語オンライン　<a href="https://gogaku559.com/" target="_blank">https://gogaku559.com/</a>
                    </dd>
                </dl>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>