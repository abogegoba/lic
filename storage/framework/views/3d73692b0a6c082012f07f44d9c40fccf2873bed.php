

<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','求人削除確認　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/company-edit/common_custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li><a href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">企業編集</li>
            <li>求人削除確認</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content" id="edit-delete">
        <h2 class="main__content__headline">求人削除確認</h2>
        <?php echo e(Form::open(['url'=>route('client.company-edit.recruiting.delete.execute',["jobApplicationsId" => $data->get("selectedJobApplicationsId")]), 'class'=>("cancelForm")])); ?>

         <p>以下の求人を削除します。よろしいですか？</p>
            <p>※1度削除した求人は復元することはできません。</p>
            <dl>
                <dt><?php echo e($data->get('title')); ?><?php echo e($data->get('jobConditions')); ?></dt>
                <dd><?php echo e($data->get('jobTypeName')); ?></dd>
            </dl>
            <div class="form__controls">
                <input type="button" value="戻る" class="prev js-btn-link" data-href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">
                <input type="submit" value="削除する" class="delete">
            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>