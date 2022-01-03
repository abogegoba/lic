<?php $__env->startSection('description'); ?>
    次世代型新卒・第二新卒採用サービス【LinkT（リンクト）】に掲載されている<?php echo e($data->get("name")); ?>の新卒採用・企業情報です。<?php echo e($data->get("name")); ?>に興味が湧いたら、メッセージやオンライン面接でさらなるコミュニケーションが取れます。
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e($data->get("name")); ?>の新卒採用、求人・企業情報｜次世代の就活ならLinkT(リンクト)
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/company-search/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/company-search/detail/index_new.css')); ?>">
    
    
    <link rel="stylesheet" href="<?php echo e(asset('js/slick/slick_custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('js/slick/slick-theme.css')); ?>">
    <style>
        .main__img picture img{
            width: 100%;
            height: auto;
        }
        .mb-15{
            margin-bottom: 15px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vue'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="/assets/js/common.js"></script>
    <script src="/assets/js/BigPicture.js"></script>
    <script src="<?php echo e(asset('js/company-search-detail/detail.js')); ?>"></script>
    
    <script>
        var body_width = $('body').width();
        var container_width = $('#container').width();
        if(container_width > 1024){
            container_width = 1000;
        }
        var company_extension_width = $('#company_extension').width();
        var company_extension_right_position = (((body_width - container_width)/2)-company_extension_width)+'px';
        $('#company_extension').css('right',company_extension_right_position);

        var maximum_top_position = (document.body.scrollHeight-document.documentElement.clientHeight);

        jQuery(document).ready(function ($) {
            /* 求人情報タブ切替
            --------------------------------------------- */
            // 初期化
            var tab = '.switchTab';
            var $list = $(tab).children('ul').children('li');

            // 初期処理：contents hide
            for (i = 0; i < $list.length; i++) {
                if (!$($list[i]).hasClass('active')) {
                    var target = $($list[i]).children('a').attr('href');
                    $(target).hide();
                }
            }

            // タブ切替処理
            $(tab + ' a').on('click', {$list: $list}, function (e) {
                var index = $(this).parent('li').index();
                var $list = e.data.$list;

                $($list).each(function () {
                    if ($(this).hasClass('active')) {
                        e.data.index = $(this).index();
                    }
                });
                // active削除・コンテンツhide
                var $active = ($list).eq(e.data.index);
                $active.removeClass('active');
                $($active.children('a').attr('href')).hide();

                // active付与・コンテンツshow
                $(this).parent('li').addClass('active');
                $($(this).parent('li').children('a').attr('href')).show();

                return false;
            })
        });

        //when scrolling
        $(document).scroll(function() {
            var current_position = $(this).scrollTop();

            if (window.matchMedia("(min-width: 1281px)").matches)
            {
                return_button_position_fixing(current_position);
            }else{
                mobile_position_fixing(current_position);
            }
        });

        var footer_height = $('#ftr').innerHeight();
        var footer_position = $('#ftr').position();
        var se = $('#company_extension');
        var margin_bottom = se.css('margin-bottom');
        function mobile_position_fixing(current_position) {
            if(current_position >= (footer_position.top - 750)){
                if(footer_height <= 40){
                    footer_height = 50;
                }
                $('#company_extension').css({
                    position: "absolute",
                    bottom: (footer_height-10)
                });
            }else{
                $('#company_extension').css({
                    position: "fixed",
                    bottom: margin_bottom
                });
            }
        }

        function return_button_position_fixing(current_position) {
            if(current_position >= (footer_position.top - 750)){
                $('#return_button').css({
                    bottom: (40+(footer_height-(maximum_top_position-current_position)))
                });
            }else{
                $('#return_button').css({
                    bottom: 40
                });
            }
        }

        $('.cursor-pointer').click(function(e){
            var event = e.target;
            big_Picture(event);
        });
        //new code
        $('.cursor-pointer>img,.cursor-pointer>span').click(function(){
            $(this).parent().click(function(e){
                var current_event = e.currentTarget;
                big_Picture(current_event);
            });
        });

        function big_Picture(et){
            if(et.tagName.toLowerCase() === 'a')
            {
                BigPicture({
                    el: et,
                    vidSrc: et.getAttribute('vidSrc'),
                })
            }
            $('#bp_vid').attr('controlsList','nodownload');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">企業検索</a></li>
            <li>企業詳細</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="contents">
        <div id="company_details">
            <div class="short_intro">
                <h3><?php echo e($data->get("name")); ?></h3>
                <p>
                    <?php $__currentLoopData = $data->get("recruitTagList"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruitTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span><?php echo e($recruitTag); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
                <p class="hash_tags">
                    <span class="tag <?php echo e($data->get("hashTagColor")); ?>"><?php echo e($data->get("hashTagName")); ?></span>
                </p>
            </div>

            <div class="full_width mt_5">
                <div class="half_width">
                    <?php if($data->get('companyPrVideoFilePath') === null): ?>
                        <div class="mb-15">
                            <div class="js_company_images">
                                <?php $__currentLoopData = $data->get('companyImageFilePathList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $companyImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <picture class="slick-slide">
                                        <img src="<?php echo e($companyImage); ?>" alt="企業画像<?php echo e($key); ?>">
                                    </picture>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="js_short_length_videos video">
                                <?php $__currentLoopData = $data->get("shortLengthVideos"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shortLengthVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <video controlsList="nodownload"  controls="controls" muted="" poster="" id="js_video_<?php echo e($key); ?>" style="display: none;" playsinline="">
                                        <source src="<?php echo e($shortLengthVideo); ?>">
                                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="member_video_or_image">
                            <div class="video">
                                <video controlsList="nodownload"  controls="" muted="" autoplay="" loop="" poster="" id="js_video_auto" playsinline="">
                                    <source src="<?php echo e($data->get("companyPrVideoFilePath")); ?>">
                                    <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                </video>
                            </div>
                            <div class="js_short_length_videos video">
                                <?php $__currentLoopData = $data->get("shortLengthVideos"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shortLengthVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <video controlsList="nodownload"  controls="controls" muted="" poster="" id="js_video_<?php echo e($key); ?>" style="display: none;" playsinline="">
                                        <source src="<?php echo e($shortLengthVideo); ?>">
                                        <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                    </video>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($data->get("shortLengthVideos.five") === null && $data->get("shortLengthVideos.ten") === null && $data->get("shortLengthVideos.fifteen") === null): ?>
                    <?php else: ?>
                        <div class="video_tags">
                            <?php if(($data->get("shortLengthVideos.five")) !== null): ?>
                                <p class="htmlvid">
                                    <a vidSrc="<?php echo e($data->get("shortLengthVideos.five")); ?>" class="tag cursor-pointer">
                                        <img src="<?php echo e(asset('/img/common/play-circle-regular.png')); ?>" alt="">
                                        <img src="<?php echo e(asset('/img/common/5sec.png')); ?>" alt="">
                                        <span><?php echo e($data->get("shortLength5sVideoTitle")); ?></span>
                                    </a>
                                </p>
                            <?php endif; ?>

                            <?php if(($data->get("shortLengthVideos.ten")) !== null): ?>
                                <p class="htmlvid">
                                    <a vidSrc="<?php echo e($data->get("shortLengthVideos.ten")); ?>" class="tag cursor-pointer">
                                        <img src="<?php echo e(asset('/img/common/play-circle-regular.png')); ?>" alt="">
                                        <img src="<?php echo e(asset('/img/common/10sec.png')); ?>" alt="">
                                        <span><?php echo e($data->get("shortLength10sVideoTitle")); ?></span>
                                    </a>
                                </p>
                            <?php endif; ?>

                            <?php if(($data->get("shortLengthVideos.fifteen")) !== null): ?>
                                <p class="htmlvid">
                                    <a vidSrc="<?php echo e($data->get("shortLengthVideos.fifteen")); ?>" class="tag cursor-pointer">
                                        <img src="<?php echo e(asset('/img/common/play-circle-regular.png')); ?>" alt="">
                                        <img src="<?php echo e(asset('/img/common/15sec.png')); ?>" alt="">
                                        <span><?php echo e($data->get("shortLength15sVideoTitle")); ?></span>
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="half_width">
                    <div class="member_intro transparent_bg pz_top pz_right pz_bottom mz_left pz_all">
                        <h2><i class="fa fa-pencil" aria-hidden="true"></i> 事業紹介</h2>
                        <p id="fs_15">
                            <?php if(($data->get('introductorySentence')) != null): ?>
                                <?php echo e($data->get("introductorySentence")); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>

            <?php if(($data->get('jobApplications')) != null): ?>
                <div class="member_details">
                    <h2><i class="fa fa-pencil" aria-hidden="true"></i> 求人詳細</h2>
                    
                    <div class="full_width">
                        <div class="all_width">
                            <div class="switchTab job_application-tab">
                                <ul>
                                    <?php $__currentLoopData = $data->get('jobApplications'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $jobApplication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e($key === 0 ? 'active':''); ?>">
                                            <a href="#<?php echo e($jobApplication->get('id')); ?>">
                                                <?php echo e(mb_strlen($jobApplication->get('title')) > 5 ? mb_substr($jobApplication->get('title'), 0, 5).'...' : $jobApplication->get('title')); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php $__currentLoopData = $data->get('jobApplications'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $jobApplication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div id="<?php echo e($jobApplication->get('id')); ?>" class="job_application_with_switch_tab">
                                    <h2><?php echo e($jobApplication->get('title')); ?></h2>
                                    <p><?php echo nl2br($jobApplication->get("recruitmentJobTypeDescription")); ?></p>
                                    <dl class="basic">
                                        <dt>募集職種</dt>
                                        <dd><?php echo e($jobApplication->get("RecruitmentJobType")->get('name')); ?></dd>
                                        <dt>仕事内容</dt>
                                        <dd><?php echo nl2br($jobApplication->get("jobDescription")); ?></dd>
                                        <dt>雇用形態</dt>
                                        <dd><?php echo e($data->get('employmentTypeList')[$jobApplication->get("employmentType")]); ?></dd>
                                        <dt>求める人物像</dt>
                                        <dd><?php echo nl2br($jobApplication->get("statue")); ?></dd>
                                        <dt>選考方法</dt>
                                        <dd><?php echo nl2br($jobApplication->get("screeningMethod")); ?></dd>
                                        <dt>給与</dt>
                                        <dd><?php echo nl2br($jobApplication->get("compensation")); ?></dd>
                                        <dt>賞与<br>昇給<br>手当</dt>
                                        <dd><?php echo nl2br($jobApplication->get("bonus")); ?></dd>
                                        <dt>勤務地</dt>
                                        <dd>
                                            <?php if(!empty($jobApplication->get("recruitmentWorkLocations"))): ?>
                                                <?php $__currentLoopData = $jobApplication->get("recruitmentWorkLocations"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prefecture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e(($key>0? ' / ':'').$prefecture->get('name')); ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </dd>
                                        <dt>勤務時間</dt>
                                        <dd><?php echo nl2br($jobApplication->get("dutyHours")); ?></dd>
                                        <dt>待遇<br>福利厚生</dt>
                                        <dd><?php echo nl2br($jobApplication->get("compensationPackage")); ?></dd>
                                        <dt>休日・休暇</dt>
                                        <dd><?php echo nl2br($jobApplication->get("nonWorkDay")); ?></dd>
                                        <dt>採用予定人数</dt>
                                        <dd><?php echo e($jobApplication->get("recruitmentNumber")); ?></dd>
                                    </dl>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($data->get("companyIntroductionListsList") !== null ): ?>
                <div class="member_details">
                    <h2><i class="fa fa-pencil" aria-hidden="true"></i> 当社の紹介</h2>
                    <?php $__currentLoopData = $data->get("companyIntroductionListsList"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $companyIntroduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="full_width">
                            <div class="half_width mb_10">
                                <?php if(preg_match('/\.(png|jpeg|jpg)$/i', $companyIntroduction->get("filePath"))): ?>
                                    <picture>
                                        <img src="<?php echo e($companyIntroduction->get("filePath")); ?>" alt="">
                                    </picture>
                                <?php else: ?>
                                    <div class="member_video_or_image">
                                        <div class="video">
                                            <video controlsList="nodownload"  controls="" muted="" autoplay="" loop="" poster="" playsinline="">
                                                <source src="<?php echo e($companyIntroduction->get("filePath")); ?>">
                                                <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                            </video>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="half_width">
                                <div class="member_intro">
                                    <h2 id="fs_15"><?php echo e($companyIntroduction->get("title")); ?></h2>
                                    <p id="fs_12">
                                        <?php echo nl2br($companyIntroduction->get("description")); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="member_details">
                <h2><i class="fa fa-pencil" aria-hidden="true"></i> 企業情報</h2>
                <div class="full_width">
                    <div class="all_width">
                        <div class="job_application">
                            <dl class="basic">
                                <dt>事業内容</dt>
                                <dd><?php echo nl2br($data->get("descriptionOfBusiness")); ?></dd>
                                <dt>設立</dt>
                                <dd><?php echo e($data->get("establishmentDate")); ?></dd>
                                <dt>資本金</dt>
                                <dd><?php echo e($data->get("capital")); ?></dd>
                                <dt>代表者</dt>
                                <dd><?php echo e($data->get("representativePerson")); ?></dd>
                                <dt>役員構成</dt>
                                <dd><?php echo nl2br($data->get("exectiveOfficers")); ?></dd>
                                <dt>事業所</dt>
                                <dd><?php echo nl2br($data->get("establishment")); ?></dd>
                                <dt>関連会社</dt>
                                <dd><?php echo nl2br($data->get("affiliatedCompany")); ?></dd>
                                <dt>登録／資格</dt>
                                <dd><?php echo nl2br($data->get("qualification")); ?></dd>
                                <dt>ホームページ</dt>
                                <?php if(filter_var($data->get("homePageUrl"), FILTER_VALIDATE_URL) && preg_match('|^https?://.*$|', $data->get("homePageUrl"))): ?>
                                    <dd><a href=<?php echo e($data->get("homePageUrl")); ?> target="_blank"><?php echo e($data->get("homePageUrl")); ?></a></dd>
                                <?php else: ?>
                                    <dd><?php echo e($data->get("homePageUrl")); ?></dd>
                                <?php endif; ?>
                                <dt>採用ホームページ</dt>
                                <?php if(filter_var($data->get("recruitmentUrl"), FILTER_VALIDATE_URL) && preg_match('|^https?://.*$|', $data->get("recruitmentUrl"))): ?>
                                    <dd><a href=<?php echo e($data->get("recruitmentUrl")); ?> target="_blank"><?php echo e($data->get("recruitmentUrl")); ?></a></dd>
                                <?php else: ?>
                                    <dd><?php echo e($data->get("recruitmentUrl")); ?></dd>
                                <?php endif; ?>
                                <dt>主要取引先</dt>
                                <dd><?php echo nl2br($data->get("mainClient")); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reload web_view" id="return_button">
            
            <form action="#" class="ftr-form">
                <input type="button" class="anchor--back cursor-pointer js-btn-link js-key-save" value="戻る" data-href="<?php echo e(route("front.company.list.reload")); ?>">
            </form>
        </div>
        <div id="company_extension">
            <div class="fixed_return mobile_tab_view">
                <form action="#" class="mobile_tab_view">
                    <input type="button" class="anchor--back cursor-pointer js-btn-link js-key-save" value="戻る" data-href="<?php echo e(route("front.company.list.reload")); ?>">
                </form>
            </div>
            <div class="fixed_tab">
                <form action="<?php echo e($data->get('messageDetailUrl')); ?>">
                    <button type="submit">
                        <p>面接依頼 or</p>
                        <p>質問をする</p>
                        <img src="<?php echo e(asset('img/common/comment-dots-regular.svg')); ?>" alt="">
                    </button>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>