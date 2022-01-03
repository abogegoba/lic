

<?php $__env->startSection('title','システムエラー　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/contact/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="main__content" id="complete">
        <h2 class="main__content__headline">
            <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($error); ?> <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></h2>
        <p>申し訳ございませんが、正しく表示できませんでした。</p>
        <p>ご不便をおかけいたしまして申し訳ございません。<br>
            ブラウザを閉じて再度やり直してください。</p>
        <footer class="anchor">
            <a onclick="location.href='<?php echo e($backUrl); ?>'" class="anchor--top cursor-pointer">戻る</a>
            <a href="<?php echo e(route('front.top')); ?>" class="anchor--top">トップへ</a>
        </footer>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>