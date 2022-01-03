<?php $__env->startSection('title','メッセージ一覧│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/message/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li>メッセージ一覧</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="main__content">
        <h2 class="main__content__headline">メッセージ一覧</h2>
        <?php if(!empty($data->get('exchangeUserAccountInformationList'))): ?>
            <?php $__currentLoopData = $data->get('exchangeUserAccountInformationList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $exchangeUserAccountInformation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="message js-link-area cursor-pointer" data-href="<?php echo e($exchangeUserAccountInformation->get('messageDetailUrl')); ?>">
                    <div class="round-img unread">
                        <picture>
                            <img src="<?php echo e($exchangeUserAccountInformation->get('companyLogo')); ?>" alt="企業ロゴ">
                        </picture>
                    </div>
                    <section class="message__body">
                        <h3><?php echo e($exchangeUserAccountInformation->get('companyName')); ?></h3>
                        <p><?php echo e($exchangeUserAccountInformation->get('content')); ?></p>
                    </section>
                    <footer>
                        <div class="message__date"><?php echo e($exchangeUserAccountInformation->get('contributionDatetime')); ?></div>
                        <?php if($exchangeUserAccountInformation->get("latestMessageSendingUserAccountId") !== $data->get("loggedInUserAccountId") && $exchangeUserAccountInformation->get('alreadyRead') === false ): ?>
                            <div class="message__isRead">未読</div>
                        <?php endif; ?>
                    </footer>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-light no-data" role="alert">
                現在データはございません
            </div>
            <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>