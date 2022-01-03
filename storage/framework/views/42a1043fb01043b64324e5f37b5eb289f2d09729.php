<?php $__env->startSection('title','Web面接予約詳細│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/video/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/video/common_custom.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){
            $('#videoInterviewLink').prop('checked', false);

            $('#videoInterviewLink').change(function(){
                if(this.checked){
                    $('#videoLink').attr('href',"<?php echo e($data->get("videoInterviewRoomUrl")); ?>");
                    $('#videoLink').css("background","#E60113");
                }else{
                    $('#videoLink').attr('href','#');
                    $('#videoLink').css("background","#808080");
                }
            });

            $('#videoLink').click(function(){
                var link = $('#videoLink').attr('href');
                if(link == '#'){
                    $('.find-company__checklists input[type=\'checkbox\'] + label').css('color','#E60113');
                    $('#linkDiv>p').show();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li><a href="<?php echo e(route('front.video-interview.list')); ?>">面接予約一覧</a></li>
            <li>予約詳細</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content">
        <div id="linkDiv">
            <p style="display: none">注意事項の推奨ブラウザを確認して面接へ進んでください。</p>
        </div>
        <h2 class="main__content__headline_interview-reserve">Web面接予約詳細</h2>
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
            <dd><?php echo e($data->get("appointmentDate")); ?></dd>
            <dt>開始時間</dt>
            <dd><?php echo e($data->get("appointmentTime")); ?></dd>
            <dt>注意事項</dt>
            <dd>
                <div class="videoInterview__checklists">
                <?php echo e(Form::checkbox('videoInterviewLink', 1, '', ["id"=>"videoInterviewLink"])); ?>

                <label for="videoInterviewLink">以下推奨ブラウザを確認して問題がなければ、チェックして面接へ進んでください。</label>
                </div>
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
                    <p>※上記以外のブラウザをご利用の場合、正常に動作しない場合がございます。</p>
                </div>
            </dd>
            <dt>内容</dt>
            <dd>
                <p><?php echo e($data->get("content")); ?></p>
            </dd>
        </dl>
        <div class="form__controls">
            <a id="videoLink" href="#">Web面接ページへ</a>
        </div>
        <div class="form__controls">
            <input type="button" value="キャンセルする" class="cancel js-btn-link" data-href="<?php echo e($data->get("videoInterviewCancelUrl")); ?>">
            <input type="button" value="戻る" class="prev js-btn-link" data-href="<?php echo e(route("front.video-interview.list")); ?>">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>