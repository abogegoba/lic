

<?php $__env->startSection('title','404'); ?>

<?php $__env->startSection('screen.title'); ?>
    <p>
        <i class="fas fa-exclamation-triangle icon text-secondary"></i>
        <em class="text-danger">404</em>
        File not found.
    </p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('screen.body'); ?>
    <p>
        お探しのページは見つかりません。<br>
        一時的にアクセスできない状態か、移動もしくは削除されてしまった可能性があります。
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