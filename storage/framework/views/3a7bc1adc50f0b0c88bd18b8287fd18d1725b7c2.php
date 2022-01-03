<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','Web面接予約詳細　｜　次世代型就活サイト　LinkT'); ?>

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
                    $('#linkDiv').show();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('client.top')); ?>">LINKT（ビジネス版） TOP</a></li>
            <li><a href="<?php echo e(route('client.video-interview.list')); ?>">Web面接</a></li>
            <li>Web面接予約詳細</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content">
        <div id="linkDiv" style="display: none">
            <p>注意事項の推奨ブラウザを確認して面接へ進んでください。</p>
        </div>
        <h2 class="main__content__headline_interview-reserve">Web面接予約詳細</h2>
        <section class="companyInfo">
            <div class="round-img">
                <picture>
                    <img src="<?php echo e($data->get('idImage')); ?>" alt="証明写真">
                </picture>
            </div>
            <div>
                <h2 class="headline--small"><a href="<?php echo e($data->get('videoInterviewRoomUrl')); ?>"><?php echo e($data->get('memberName')); ?></a><span>（<?php echo e($data->get('age')); ?>歳／<?php echo e($data->get('graduationPeriod')); ?>

                        年卒業予定）</span></h2>
                <p><?php echo e($data->get('schoolName')); ?>／<?php echo e($data->get('departmentName')); ?></p>
                <?php if(!empty($data->get('hashTagName'))): ?>
                    <p class="tag <?php echo e($data->get("hashTagColor")); ?>"><?php echo e($data->get('hashTagName')); ?></p>
                <?php endif; ?>
            </div>
        </section>
        <dl class="basic">
            <dt>予約日</dt>
            <dd><?php echo e($data->get('appointmentDate')); ?></dd>
            <dt>開始時間</dt>
            <dd><?php echo e($data->get('appointmentTime')); ?></dd>
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
                <p><?php echo e($data->get('content')); ?></p>
            </dd>
        </dl>
        <div class="form__controls">
            <a id="videoLink" href="#">Web面接ページへ</a>
        </div>
        <form action="<?php echo e($data->get('videoInterviewCancelUrl')); ?>">
            <div class="form__controls">
                <button type="button" class="prev js-btn-link" data-href="<?php echo e(route("client.video-interview.list")); ?>">戻る</button>
                <input type="submit" value="キャンセルする" class="cancel">
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('client.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>