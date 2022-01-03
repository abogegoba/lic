

<?php $__env->startSection('title','会員登録の受付完了│会員登録｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/entry/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header id="main__hdr">
        <h1>会員登録受付完了</h1>
    </header>
    <section id="main__content">
        <h2>会員登録を受付けました</h2>
        <p>ご登録ありがとうございました。</p>
        <p>ご入力いただきましたメールアドレス宛に確認のメールを送付いたしました。</p>
        <p>お手数ですがご確認いただき、手続きを完了してください。</p>
        <nav><a href="<?php echo e(route('front.top')); ?>" class="button">トップへ</a>
        </nav>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>