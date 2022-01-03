

<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','求人情報の編集│企業編集｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/company-edit/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            <?php if(session('success') === 'delete'): ?>
            $('#delete-complete').show();
            setTimeout(function () {
                $('#delete-complete').fadeOut(1500);
            }, 2000);
            <?php else: ?>
            $('#delete-complete').remove();
            <?php endif; ?>

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
            <?php elseif($errors->get("business_exception")): ?>
            setTimeout(function () {
                $('#errors').fadeOut(1500);
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
            <li>企業編集</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content" id="edit-recruiting">
        <h2 class="main__content__headline">企業編集</h2>
        <?php echo $__env->make('client.common.flash_message.business_error', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="alert" id="create-complete" hidden>登録しました</div>
        <div class="alert" id="edit-complete" hidden>変更しました</div>
        <div class="alert" id="delete-complete" hidden>削除しました</div>
        <div class="form__controls" style="margin-bottom: 1em;">
            <button class="preview js-btn-target-blank" data-href="<?php echo e(route('client.company-edit.basic-information.preview')); ?>">登録内容でプレビュー</button>
        </div>
        <section class="switchTab">
            <ul>
                <li><a href="<?php echo e(route('client.company-edit.basic-information')); ?>">基本情報</a></li>
                <li class="active"><a href="<?php echo e(route('client.company-edit.recruiting.list')); ?>">求人一覧</a></li>
            </ul>
        </section>
        <button class="button add js-btn-link" data-href="<?php echo e(route('client.company-edit.recruiting.create')); ?>">求人を追加</button>
        <?php if(!empty($data->get('companyRecruitingList'))): ?>
            <?php $__currentLoopData = $data->get('companyRecruitingList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $companyRecruiting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form__modify">
                    <dl>
                        <dt>
                            <a href="<?php echo e(route('client.company-edit.recruiting.edit', ["jobApplicationsId" => $key])); ?>"><?php echo e($companyRecruiting->get('title')); ?></a><?php echo e($companyRecruiting->get('jobConditions')); ?>

                        </dt>
                        <dd><?php echo e($companyRecruiting->get('jobTypeName')); ?></dd>
                    </dl>
                    <form action="<?php echo e(route('client.company-edit.recruiting.delete.confirm',["jobApplicationsId" => $key])); ?>">
                        <button class="button button-submit">削除</button>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-light no-data" role="alert">
                現在登録されている求人はございません
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>