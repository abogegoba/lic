

<?php $__env->startSection('title','システムエラー　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/contact/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="main__content" id="complete">
        <h2 class="main__content__headline">システムエラー</h2>
        <p>申し訳ございませんが、正しく表示できませんでした。</p>
        <p>ご不便をおかけいたしまして申し訳ございません。<br>
            ブラウザを閉じて再度やり直してください。</p>
        <footer class="anchor">
            <a href="<?php echo e(route('client.top')); ?>" class="anchor--top">トップへ</a>
        </footer>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>