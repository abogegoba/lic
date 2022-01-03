

<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','求人変更　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/company-edit/common_custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            <?php if(session('success') === 'create'): ?>
            $('#create-complete').show();
            setTimeout(function () {
                $('#create-complete').fadeOut(1500);
            }, 2000);
            <?php elseif(session('success') === 'edit'): ?>
            $('#edit-complete').show();
            setTimeout(function () {
                $('#edit-complete').fadeOut(1500);
            }, 2000);
            <?php else: ?>
            $('#create-complete').remove();
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li><a href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">企業編集</a></li>
            <li>求人変更</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content" id="edit-entry">
        <div class="alert" id="create-complete" hidden>登録しました</div>
        <div class="alert" id="edit-complete" hidden>変更しました</div>

        <h2 class="main__content__headline">求人変更</h2>
        <?php echo e(Form::open(['url'=>route('client.company-edit.recruiting.edit.execute',["jobApplicationsId" => $data->get("selectedJobApplicationsId")])])); ?>

            <?php echo $__env->make('client.company-edit.parts.input_recruiting', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="form__controls">
                <button class="prev js-btn-link" data-href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">戻る</button>
                <input type="submit" value="変更する" class="save">
            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>