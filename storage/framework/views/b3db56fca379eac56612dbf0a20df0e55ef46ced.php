<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','Web面接予約確認　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/video/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/video/common_custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li><a href="<?php echo e(route('client.video-interview.list')); ?>">Web面接</a></li>
            <li>Web面接予約確認</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content">
        <h2 class="main__content__headline">Web面接予約登録</h2>
        <section class="companyInfo">
            <div class="round-img">
                <picture>
                    <img src="<?php echo e($data->get('idImage')); ?>" alt="証明写真">
                </picture>
            </div>
            <div>
                <h2 class="headline--small"><a><?php echo e($data->get('memberName')); ?></a><span>（<?php echo e($data->get('age')); ?>歳／<?php echo e($data->get('graduationPeriod')); ?>年卒業予定）</span></h2>
                <p><?php echo e($data->get('schoolName')); ?>／<?php echo e($data->get('departmentName')); ?></p>
                <?php if(!empty($data->get('hashTagName'))): ?>
                    <p class="tag <?php echo e($data->get("hashTagColor")); ?>"><?php echo e($data->get('hashTagName')); ?></p>
                <?php endif; ?>
            </div>
        </section>
        <dl class="basic">
            <dt>予約日</dt>
            <dd><?php echo e($data->get("date")); ?></dd>
            <dt>開始時間</dt>
            <dd><?php echo e($data->get("time")); ?></dd>
            <dt>内容</dt>
            <dd>
                <p><?php echo e($data->get("content")); ?></p>
            </dd>
        </dl>
        <?php echo e(Form::open(['url'=>route('client.video-interview.execute',['userAccountId'=>$data->get("memberUserAccountId")])])); ?>

            <p class="confirmMessage">上記の内容で面接を予約します。よろしいですか？<br>面接を予約すると学生にお知らせのメールが送信されます。</p>
            <div class="form__controls">
                <input type="button" value="戻る" class="prev js-btn-link" data-href="<?php echo e($data->get("videoInterviewReviseUrl")); ?>">
                <input type="submit" value="面接を予約する" class="next">
            </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>