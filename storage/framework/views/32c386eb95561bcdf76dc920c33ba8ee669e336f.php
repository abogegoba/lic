<?php $__env->startSection('description','次世代型新卒・第二新卒採用サービス【LinkT（リンクト）】の企業向けご利用ガイドです。企業情報や動画、写真をアップロードしてマイページ登録が完了すれば、学生とサイト内で直接コミュニケーションを図ることができます。採用活動の質を上げることで新卒採用の最大化を実現します。'); ?>

<?php $__env->startSection('title','企業向けご利用ガイド｜新卒・第二新卒採用ならLinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/use/about/index.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/use/about/index_custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/use/index.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li>LinkTご利用ガイド</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="main__catch">
        <h2 class="headline">LinkTご利用ガイド</h2>
    </section>
    <section class="main__content">
        <section class="content__block">
            <picture>
                <source media="(max-width: 767px)" srcset=<?php echo e(asset("/img/client/use/img_company01-sp.jpg")); ?>>
                <img src="<?php echo e(asset("/img/client/use/img_company01-pc.jpg")); ?>" alt="">
            </picture>
            <div>
                <h2>01 ご登録</h2>
                <p>企業情報、企業PR動画のご登録</p>
                <p>動画は通常尺の他、学生に人気の<br>5秒・10秒・15秒の短縮動画も掲載可能</p>
            </div>
        </section>
        <section class="content__block">
            <div>
                <h2>02 学生検索</h2>
                <p>採用したい学生や興味のある学生を条件検索し、<br>学生の自己PR動画や履歴書をチェックして情報収集</p>
            </div>
            <picture>
                <source media="(max-width: 767px)" srcset=<?php echo e(asset("/img/client/use/img_company02-sp.jpg")); ?>>
                <img src="<?php echo e(asset("/img/client/use/img_company02-pc.jpg")); ?>" alt="">
            </picture>
        </section>
        <section class="content__block">
            <picture>
                <source media="(max-width: 767px)" srcset=<?php echo e(asset("/img/client/use/img_company03-sp.jpg")); ?>>
                <img src="<?php echo e(asset("/img/client/use/img_company03-pc.jpg")); ?>" alt="">
            </picture>
            <div>
                <h2>03 メッセージ</h2>
                <p>メッセンジャーで学生と直接のコミュニケーションが可能</p>
            </div>
        </section>
        <section class="content__block">
            <div>
                <h2>04 面接予約</h2>
                <p>メッセージ画面から面接ご予約</p>
                <p>面接ご予約完了時、<br class="pc">Web面接URL発行</p>
            </div>
            <picture>
                <source media="(max-width: 767px)" srcset=<?php echo e(asset('/img/client/use/img_company04-sp.jpg')); ?>>
                <img src="<?php echo e(asset("/img/client/use/img_company04-pc.jpg")); ?>" alt="">
            </picture>
        </section>
        <section class="content__block">
            <picture>
                <source media="(max-width: 767px)" srcset=<?php echo e(asset("/img/client/use/img_company05-sp.jpg")); ?>>
                <img src="<?php echo e(asset("/img/client/use/img_company05-pc.jpg")); ?>" alt="">
            </picture>
            <div>
                <h2>05 面接実施</h2>
                <p>面接時間になり学生がWeb面接ルームに入り次第、面接開始</p>
            </div>
        </section>
        <section class="content__block">
            <div>
                <h2>06 面接結果通知</h2>
                <p></p>
                <p>1次・2次面接、インターン選考をLinkTで実施する企業様多数</p>
            </div>
            <picture>
                <source media="(max-width: 767px)" srcset=<?php echo e(asset("/img/client/use/img_company06-sp.jpg")); ?>>
                <img src="<?php echo e(asset("/img/client/use/img_company06-pc.jpg")); ?>" alt="">
            </picture>
        </section>
    </section>
    <nav class="footerNav navSp fontSize--small">
        <ul>
            <li><a href="<?php echo e(route('client.contact')); ?>">企業会員登録</a></li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>