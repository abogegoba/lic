

<?php $__env->startSection('title','500'); ?>

<?php $__env->startSection('screen.title'); ?>
    <p>
        <i class="fas fa-exclamation-triangle icon text-secondary"></i>
        <em class="text-danger">500</em>
        エラーが発生しました
    </p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('screen.body'); ?>
    <p>
        ご迷惑をおかけして申し訳ありません。<br>
        しばらく時間をおいてから再度アクセスしてください。
    </p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('btn.row'); ?>
    <div class="btn-col btn-row-sm">
        <a href="<?php echo e(route('admin.company.list')); ?>" class="btn btn-lg btn-primary">
            トップページに戻る
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.errors.common', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>