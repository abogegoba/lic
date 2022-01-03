

<?php $__env->startSection('title','求人登録'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .display-company-data {
            margin-top: 10px;
        }
        .can-not-recruiting-create {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="content-title">求人登録</h1>
    <?php echo $__env->make('admin.common.input_message_outside_frame', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <main class="col-12 col-md-9 col-xl-10 main-content">

        <div style="margin-bottom: 2em;">
            <a href="<?php echo e(route('admin.jobApplication.list.reload')); ?>">< 求人一覧に戻る</a>
        </div>

        <?php echo e(Form::open(['url' => route('admin.job-application.create')])); ?>


        <?php echo $__env->make('admin.job_application.parts.input', ['viewType' => 'create'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="can-not-recruiting-create">
            <?php echo $__env->make('admin.common.business_error', ['errors' => $errors, 'target' => 'can_not_recruiting_create'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="btn-row btn-row" style="margin-bottom: 2em;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-create">
                    <i class="iconfont iconfont-plus-circle icon-lg" aria-hidden="true"></i>
                    <span>登録する</span>
                </button>
            </div>
        </div>

        <a href="<?php echo e(route('admin.jobApplication.list.reload')); ?>">< 求人一覧に戻る</a>
        <?php echo $__env->make('admin.common.modals.create_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo e(Form::close()); ?>

    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/job_application/input.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>