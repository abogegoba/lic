

<?php $__env->startSection('title','会員登録完了│会員登録｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/entry/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <header id="main__hdr">
        <h1>会員登録完了</h1>
    </header>
    <section id="main__content">
        <h2>会員登録を完了しました。</h2>
        <p>ご登録ありがとうございました。</p>
        <p>ぜひ本サービスをご活用いただき、有意義な就活にお役立てください。</p>
        <p>今後とも本サービスをよろしくお願いいたします。</p>
        <nav>
            <a href="<?php echo e(route('front.top')); ?>" class="button">トップへ</a>
            <a href="<?php echo e(route('front.member.login')); ?>" class="button">ログインする</a>
        </nav>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>