

<?php $__env->startSection('title','ページが見つかりません　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/contact/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="main__content" id="complete">
        <h2 class="main__content__headline">ページが見つかりません</h2>
        <p>お探しのページは見つかりませんでした。申し訳ございません。<br>
            ご指定のページは存在しないか移動した可能性がございます。</p>
        <footer class="anchor">
            <a href="<?php echo e(route('client.top')); ?>" class="anchor--top">トップへ</a>
        </footer>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>