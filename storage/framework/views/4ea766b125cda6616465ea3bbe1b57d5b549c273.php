<?php $__env->startSection('title','Web面接予約キャンセル│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/video/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/video/common_custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li><a href="<?php echo e(route('front.video-interview.list')); ?>">面接予約一覧</a></li>
            <li>予約キャンセル確認</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content">
        <h2 class="main__content__headline">Web面接予約詳細</h2>
        <p class="cancelMessage">以下の予約をキャンセルしますか？</p>
        <h2 class="headline--small"><?php echo e($data->get("companyName")); ?></h2>
        <section class="companyInfo">
            <div>
                <dl>
                    <dt>業種：</dt>
                    <dd><?php echo e($data->get("formattedBusinessTypes")); ?></dd>
                </dl>
                <dl>
                    <dt>本社：</dt>
                    <dd><?php echo e($data->get("headOfficePrefecture")); ?></dd>
                </dl>
                <p><?php echo e($data->get("introductorySentence")); ?></p>
            </div>
        </section>
        <dl class="basic">
            <dt>予約日</dt>
            <dd><?php echo e($data->get("appointmentDate")); ?>(木)</dd>
            <dt>開始時間</dt>
            <dd><?php echo e($data->get("appointmentTime")); ?></dd>
            <dt>内容</dt>
            <dd>
                <p><?php echo e($data->get("content")); ?></p>
            </dd>
        </dl>
        <?php echo e(Form::open(['url'=>route('front.video-interview.cancel-execute',['userAccountId'=>$data->get("interviewAppointmentId")]), 'class'=>("cancelForm")])); ?>

        <dl>
            <dt>キャンセルメッセージ</dt>
            <dd class="invalid-form">
                <?php echo e(Form::textarea('cancelMessage', '', ["class" => (!empty($errors->has('contact')) ? "invalid-control width100" : "width100"), "id"=>"cancelMessage", "cols"=>"30", "rows"=>"10", "placeholder" => "この度は勝手ながら御社の面接を辞退させていただけますと幸いです。",  "maxlength" => 400])); ?>

                <?php echo $__env->make('front.common.input_error', ['errors' => $errors, 'targets' => ['cancelMessage']], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </dd>
        </dl>
        <div class="form__controls">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="<?php echo e($data->get("videoInterviewListUrl")); ?>">
            <input type="submit" value="キャンセルする" class="cancel">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>