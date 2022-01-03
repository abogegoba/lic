

<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','求人登録　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/company-edit/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li><a href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">企業編集</a></li>
            <li>求人登録</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/common_custom.js')); ?>"></script>
    <script>
        $(function () {
            $(document).on('click', '.js-btn-submit', function () {
                var btn = $(this);
                setTimeout(function () {
                    btn.prop("disabled", false);
                }, 6000);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content" id="edit-entry">
        <h2 class="main__content__headline">求人登録</h2>
        <?php echo e(Form::open(['url'=>route('client.company-edit.recruiting.create.execute')])); ?>


            <?php echo $__env->make('client.company-edit.parts.input_recruiting', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="form__controls">
                <button class="prev js-btn-link" data-href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">戻る</button>
                <input type="submit" value="登録する" class="save js-btn-submit">
            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>