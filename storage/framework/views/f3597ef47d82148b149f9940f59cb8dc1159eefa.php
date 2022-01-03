<?php $__env->startSection('title','Web面接画面│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/video/common.css')); ?>">
    <style>
        #browser_recommandation_container {padding: 30px 50px 30px;text-align: justify;background: #F0FCFF;}
        #browser_recommandation_container>p {margin-bottom: 1.5em;font-weight: 700;color: #2a2a2a;font-size: 15px;}
        #browser_support {margin-bottom: 1.5em;}
        #browser_support p {font-weight: 700;color: #2a2a2a;}
        #pc_browser,#mobile_browser {border-left: 3px solid #0081CC;padding-left: 15px;margin-bottom: 15px;}
        #pc_browser ul,#mobile_browser ul {display: inline-grid;min-width: 40%;line-height: 1.5;}
        #pc_browser ul li, #mobile_browser ul li {list-style: disc;margin-left: 30px;}

        @media  only screen and (max-width: 767px) and (min-width: 320px){
            #browser_recommandation_container {padding: 25px 25px;margin: 30px 30px 0px 30px;}
            #browser_support {font-size: 15px;}
            .video__interview {
                margin-bottom: 0;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/skyway.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/mypage/video/room.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li>Web面接</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div id="js-video-container" class="main__content"
         data-api-key="<?php echo e(env("SKYWAY_API_KEY")); ?>"
         data-my-peer-id="<?php echo e($data->get("memberPeerId")); ?>"
         data-their-peer-id="<?php echo e($data->get("companyPeerId")); ?>"
         data-video-start-url="<?php echo e(route("front.video-interview.start",$data->get("interviewAppointmentId"))); ?>"
         data-video-end-url="<?php echo e(route("front.video-interview.end","[videoCallHistoryId]")); ?>"
         data-interview-appointment-id="<?php echo e($data->get("interviewAppointmentId")); ?>">
        <div class="video__interview">
            <video id="their-video" autoplay playsinline controls></video>
        </div>
        <div class="form__controls" >
            <input type="submit" class="js-peer-button" style="display:none">
        </div>
        <div id="browser_recommandation_container">
            <p>Web面接をご利用いただくためには、下記デバイス・ブラウザのご利用を推奨いたします。 推奨していないブラウザでご利用いただくと「接続ボタン」が表示されない場合があります。</p>
            <div id="browser_support">
                <div id="pc_browser">
                    <p>PC</p>
                    <ul>
                        Windows
                        <li>Google Chrome 最新版</li>
                        <li>Firefox 最新版</li>
                    </ul>
                    <ul>
                        Mac
                        <li>Google Chrome 最新版</li>
                        <li>Firefox 最新版</li>
                        <li>Safari 最新版</li>
                    </ul>
                </div>
                <div id="mobile_browser">
                    <p>スマートフォン</p>
                    <ul>
                        iOS
                        <li>Safari 最新版（標準ブラウザ）</li>
                    </ul>
                    <ul>
                        Android
                        <li>Google Chrome 最新版（標準ブラウザ）</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>