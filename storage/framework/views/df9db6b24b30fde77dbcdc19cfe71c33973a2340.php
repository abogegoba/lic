

<?php $__env->startSection('title','求人変更'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .display-company-data {
            margin-top: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.common.input_message_outside_frame', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <main class="col-12 col-md-9 col-xl-10 main-content">
        <?php echo e(Form::open(['url' => route('admin.job-application.edit', ['jobApplicationId'=>$data->get('jobApplication.id')])])); ?>


        <h1 class="content-title">求人変更</h1>
        <?php if(session('success') === 'create'): ?>
            
            <?php echo $__env->make('admin.common.create_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if(session('success') === 'edit'): ?>
            
            <?php echo $__env->make('admin.common.edit_complete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <a href="<?php echo e(route('admin.jobApplication.list.reload')); ?>">< 求人一覧に戻る</a>

        <div class="btn-row btn-row" style="text-align: right;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg js-btn-target-blank" data-href="<?php echo e(route('admin.job-application.preview', ['jobApplicationId'=>$data->get('company.id')])); ?>">
                    <span>プレビューする</span>
                </button>
            </div>
        </div>

        <?php echo $__env->make('admin.job_application.parts.input', ['viewType' => 'edit'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="btn-row btn-row" style="margin-bottom: 2em;">
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-edit">
                    <i class="fas fa-plus-circle icon icon-lg"></i>
                    <span>変更する</span>
                </button>
            </div>
            <div class="btn-col btn-row-sm">
                <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#modal-delete">
                    <span>削除する</span>
                </button>
            </div>
        </div>

        <a href="<?php echo e(route('admin.jobApplication.list.reload')); ?>">< 求人一覧に戻る</a>
        <?php echo $__env->make('admin.common.modals.edit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('admin.common.modals.delete_confirm_modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo e(Form::close()); ?>

    </main>
<?php $__env->stopSection(); ?>

<?php echo e(Form::open(['id' => 'js-delete-target-id', 'url' => route('admin.jobApplication.delete', ['jobApplicationId' => $data->get('jobApplication.id')])])); ?>

<?php echo e(Form::close()); ?>


<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/job_application/input.js')); ?>"></script>
    <script>
        $(function () {
            <?php if(session('success') === 'create'): ?>
            $("#create-complete").show();
            setTimeout(function () {
                $("#create-complete").fadeOut(1500);
            }, 2000);
            <?php elseif(session('success') === 'edit'): ?>
            $("#edit-complete").show();
            setTimeout(function () {
                $("#edit-complete").fadeOut(1500);
            }, 2000);
            <?php endif; ?>

            /**
             * ボタンリンク（別タブ表示）
             */
            $(document).on('click', '.js-btn-target-blank', function () {
                var href = $(this).data('href');
                window.open(href);
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>