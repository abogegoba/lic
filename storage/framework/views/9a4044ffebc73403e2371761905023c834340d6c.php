<?php $__env->startSection('description','新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】の学生向けご利用ガイドです。学生がLinkTを使って就職活動をする際の手順について説明しています。動画や履歴書をアップロードして会員登録を完了させれば、企業探しから採用面接までLinkTのみで行えます。'); ?>

<?php $__env->startSection('title','LinkT（リンクト）の使い方｜次世代の就活ならLinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/describe/base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/describe/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/describe/modalwindow.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.css">
    <style>
        .customer_info {
            background: url("<?php echo e(asset('img/describe/vo_ja22.png')); ?>") no-repeat;
            background-size: cover;
            background-position: 0px -120px;
        }
        /* .customer_info > .all {
            margin-left: calc(100% - 416px);
            padding: 110px 30px 96px 0px;
        } */
        @media  only screen and (min-width: 768px) and (max-width: 1024px) {
            .customer_info {
                background-position: 0px -50px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo e(asset('js/describe/modalwindow.js')); ?>"></script>
    <script src="<?php echo e(asset('js/describe/library.js')); ?>"></script>
    <script src="<?php echo e(asset('js/describe/ofi.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.js"></script>
    <script>
        objectFitImages();
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.static.customer')); ?>">利用者の声</a></li>
            <li>利用者の声詳細</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section id="voice">
        <div class="inner">
            <div class="page_intro">
                <img src="<?php echo e(asset('img/common/logo.png')); ?>" alt="LinkT">
                <span>ここがイイ！</span>
                <div class="caption">1社ずつ履歴書を作成する必要がない！</div>
            </div>

            <div class="customer_info">
                <div class="all">
                    <p>日本大学 J・Aさん</p>
                    <h3>充実した就活ができる。</h3>
                    <p>
                        LinkTなら内定率を高められると思います。<br>面接一発勝負よりも、
                        自分を知ってもらうページを作成して実際に会う前から印象付けることができれば有利に就活を進められるのではないかと思います。
                        <br>
                        自分らしく充実した就活を行えるように周りの友人にもLinkTをおすすめしようと思っています。
                    </p>

                    <a class="molink pco" href="<?php echo e(asset('video/describe/customer3.mp4')); ?>" data-lity>J・Aさんの自己PR動画を見る ▶</a>
                </div>
            </div>

            <div class="customer_info_mobile">
                <img src="<?php echo e(asset('img/describe/vo_ja2.png')); ?>" alt="">
                <div class="all">
                    <p class="name">日本大学 J・Aさんん</p>
                    <h3>充実した就活ができる。</h3>
                    <p>
                        LinkTなら内定率を高められると思います。<br>面接一発勝負よりも、
                        自分を知ってもらうページを作成して実際に会う前から印象付けることができれば有利に就活を進められるのではないかと思います。
                        <br>
                        自分らしく充実した就活を行えるように周りの友人にもLinkTをおすすめしようと思っています。
                    </p>
                </div>
            </div>

            <a class="molink spo" href="<?php echo e(asset('video/describe/customer3.mp4')); ?>" data-lity>J・Aさんの自己PR動画を見る ▶</a>
            <a href="<?php echo e(route('front.static.customer')); ?>" class="btn">▶ 利用者の声一覧</a>
            
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>