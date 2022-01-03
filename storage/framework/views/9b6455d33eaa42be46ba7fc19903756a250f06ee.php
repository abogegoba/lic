<?php $__env->startSection('description','会員登録：基本情報入力'); ?>

<?php $__env->startSection('title','学生詳細　｜　次世代型就活サイト　LinkT'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/profile/preview/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/profile/preview/detail/index_new.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.css">
    <link rel="stylesheet" href="<?php echo e(asset('js/slick/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('js/slick/slick-theme.css')); ?>">
    <style>
        .client button {
            background: transparent;
        }
        .slick-slide {
            margin: 0 5px;
        }
        .slick-list {
            margin: 0px -5px 0px -5px;
        }
        .slick-prev, .slick-next {
            top: 50% !important;
        }
        .slick-next {
            right: -20px !important;
        }
        .slick-next:before {
            font-family: fontawesome;
            content: '\f105';
            color: #000;
        }
        .slick-prev {
            left: -20px !important;
        }
        .slick-prev:before {
            font-family: fontawesome;
            content: '\f104';
            color: #000;
        }
        .slick-dots li{
            margin: 0;
        }
        .slick-dots li button::before{
            font-family: fontawesome;
            content: '\f111';
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/1.6.6/lity.js"></script>
    <script>
        var body_width = $('body').width();
        var container_width = $('#container').width();
        if(container_width > 1024){
            container_width = 1000;
        }
        var student_extension_width = $('#student_extension').width();
        var student_extension_right_position = (((body_width - container_width)/2)-student_extension_width)+'px';
        $('#student_extension').css('right',student_extension_right_position);

        var student_scroll_profile_width = 200;
        var student_scroll_profile_left_position = (((body_width - container_width)/2)-student_scroll_profile_width)+'px';
        $('#student_scroll_profile').css('left',student_scroll_profile_left_position);

        var height_a = $('.short_intro').height();
        var height_b = $('.full_width').first().height();

        var scroll_position = $('.scroll_position').position();
        var hide_position = (scroll_position.top-height_b)+height_a;

        var student_extension_position = $('#student_extension').position();
        var student_extension_height = $('#student_extension').height();

        var maximum_top_position = (document.body.scrollHeight-document.documentElement.clientHeight);
        var open_now = '';

        $(document).ready(function(){
            var dot_status = true;
            if($('.selected_image img').length == 1){
                dot_status = false;
            }
            if($('.si img').length == 1){
                dot_status = false;
            }
            $('.selected_image, .si').slick({
                arrows: true,
                dots: dot_status,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                            arrows: false,
                            dots: dot_status,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 801,
                        settings: {
                            arrows: false,
                            dots: dot_status,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            arrows: false,
                            dots: dot_status,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            arrows: false,
                            dots: dot_status,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            $('.small').click(function () {
                var that = $(this);
                var image_source = that.attr('src');
                var image_alt = that.attr('alt');

                $('.all_image .img_active').removeClass('img_active');
                $('.ai .img_active').removeClass('img_active');
                that.addClass('img_active');
                $('.large').attr('src',image_source);
                $('.large').attr('alt',image_alt);
            });

            var current_position = $(this).scrollTop();
            hidden_profile(current_position);

            $('.hidden_profile_image i').click(function () {
                $('.hidden_profile_image').hide();
                $('.profile_link').show();

                var student_scroll_profile_width = $('.profile_link').outerWidth();
                var student_scroll_profile_left_position = (((body_width - container_width)/2)-student_scroll_profile_width)+'px';
                $('#student_scroll_profile').css('left',student_scroll_profile_left_position);

                if (window.matchMedia("(min-width: 1281px)").matches)
                {
                    //position_fixing(current_position);
                }else{
                    mobile_position_fixing(y);
                }

                open_now = 'profile_link';
            });

            $('.profile_link').click(function () {
                $('.profile_link').hide();
                $('.hidden_profile_image').show();

                var student_scroll_profile_width = $('.hidden_profile_image').outerWidth();
                var student_scroll_profile_left_position = (((body_width - container_width)/2)-student_scroll_profile_width)+'px';
                $('#student_scroll_profile').css('left',student_scroll_profile_left_position);

                if (window.matchMedia("(min-width: 1281px)").matches)
                {
                    //position_fixing(current_position);
                }else{
                    mobile_position_fixing(current_position);
                }

                open_now = 'hidden_profile_image';
            });

        });

        //when scrolling
        $(document).scroll(function() {
            var current_position = $(this).scrollTop();
            if (current_position > hide_position) {
                if(open_now == '' || open_now == 'hidden_profile_image'){
                    if($(".profile_link").is(":visible")){
                        $('.hidden_profile_image').hide();
                    } else{
                        $('.hidden_profile_image').show();
                        $('.profile_link').hide();

                        var student_scroll_profile_width = $('.hidden_profile_image').outerWidth();
                        var student_scroll_profile_left_position = (((body_width - container_width)/2)-student_scroll_profile_width)+'px';
                        $('#student_scroll_profile').css('left',student_scroll_profile_left_position);
                    }
                }else if(open_now == 'profile_link'){
                    if($(".hidden_profile_image").is(":visible")){
                        $('.profile_link').hide();
                    } else{
                        $('.profile_link').show();
                        $('.hidden_profile_image').hide();

                        var student_scroll_profile_width = $('.profile_link').outerWidth();
                        var student_scroll_profile_left_position = (((body_width - container_width)/2)-student_scroll_profile_width)+'px';
                        $('#student_scroll_profile').css('left',student_scroll_profile_left_position);
                    }
                }
            } else {
                $('.hidden_profile_image').hide();
                $('.profile_link').hide();
            }

            if (window.matchMedia("(min-width: 1281px)").matches)
            {
                //position_fixing(current_position);
                return_button_position_fixing(current_position);
            }else{
                mobile_position_fixing(current_position);
            }

            if (window.matchMedia("(max-width: 1281px)").matches)
            {
                var fix_short_info_position = 130;
                if(current_position > fix_short_info_position){
                    $('.short_intro_and_selected_image').css('width',(parseInt(body_width)-((parseInt(body_width)-parseInt(container_width))))+'px');
                    var left_position_calculation = ((parseInt(body_width)-parseInt(container_width))/2)+'px';
                    $('.short_intro_and_selected_image').css('left',left_position_calculation);
                    $('.short_intro_and_selected_image').addClass('fixed_short_into');
                }else{
                    $('.short_intro_and_selected_image').removeClass('fixed_short_into');
                }
            }



        });

        function hidden_profile(current_position){
            if (current_position > hide_position) {
                if($(".profile_link").is(":visible")){
                    $('.hidden_profile_image').hide();
                } else{
                    $('.hidden_profile_image').show();
                    $('.profile_link').hide();
                }
            } else {
                $('.hidden_profile_image').hide();
                $('.profile_link').hide();
            }

            if (window.matchMedia("(min-width: 1281px)").matches)
            {
                //position_fixing(current_position);
                return_button_position_fixing(current_position);
            }else{
                mobile_position_fixing(current_position);
            }
        }

        /*function position_fixing(current_position) {
            var top_px = '';
            if($(".profile_link").is(":visible")){
                var extra_top = 43;
            }else{
                var extra_top = 0;
            }

            if(current_position > (maximum_top_position - 10)){
                if (window.matchMedia("(width: 1440px)").matches)
                {
                    top_px = ((student_extension_position.top + 142 )+extra_top)+'px';
                }else{
                    top_px = ((student_extension_position.top -3 )+extra_top)+'px';
                }
            }else{
                top_px = student_extension_position.top+'px';
            }
            $('#student_extension').css({"top": top_px, "transition": "top 500ms"});
        }*/

        var footer_height = $('#ftr').innerHeight();
        var se = $('#student_extension');
        var margin_bottom = se.css('margin-bottom');
        function mobile_position_fixing(current_position) {
            if(current_position >= (maximum_top_position - (footer_height+se.innerHeight()+parseInt(margin_bottom)+125))){
                $('#student_extension').css({
                    position: "absolute",
                    bottom: footer_height
                });
            }else{
                $('#student_extension').css({
                    position: "fixed",
                    bottom: margin_bottom
                });
            }
        }

        function return_button_position_fixing(current_position) {
            if(current_position >= (maximum_top_position - footer_height)){
                $('#return_button').css({
                    bottom: (40+(footer_height-(maximum_top_position-current_position)))
                });
            }else{
                $('#return_button').css({
                    bottom: 40
                });
            }
        }

        $(document).on('click', '.lity-close, .lity-wrap', function() {
            var video = $('#video').get(0);
            video.pause();
            video.currentTime = 0;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></li>
            <li>プレビュー</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- new design -->
    <section class="contents">
        <div id="student_details">
            <div class="short_intro web_view">
                <h3><?php echo e($data->get('member.lastName')); ?>　<?php echo e($data->get('member.firstName')); ?>

                    <span>
                        （<?php echo e($data->get('member.lastNameKana')); ?>　<?php echo e($data->get('member.firstNameKana')); ?><?php if($data->get('member.country') > 1 && $data->get('member.englishName') != ''): ?>／<?php echo e($data->get('member.englishName')); ?><?php endif; ?>）
                    </span>
                </h3>
                <p><?php echo e($data->get('member.age').'歳'); ?>／<?php echo e($data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')); ?><?php echo e($data->get('member.oldSchool.alreadyGraduated')? '卒業':'卒業予定'); ?></p>
                <p><?php echo e($data->get('member.oldSchool.name')); ?>／<?php echo e($data->get('member.oldSchool.departmentName')); ?></p>
            </div>

            <!--mobile/tab version-->
            <div class="short_intro_and_selected_image mobile_tab_view">
                <div class="si">
                    
                    <?php if($data->get('member.idPhotoFilePathForClientShow') == asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') == asset('/img/client/student-search/samplestudent04.jpg')): ?>
                        <div>
                            <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                        </div>
                    <?php else: ?>
                        <?php if($data->get('member.idPhotoFilePathForClientShow') != asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') == asset('/img/client/student-search/samplestudent04.jpg')): ?>
                            <div>
                                <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                            </div>
                        <?php elseif($data->get('member.idPhotoFilePathForClientShow') == asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') != asset('/img/client/student-search/samplestudent04.jpg')): ?>
                            <div>
                                <img src="<?php echo e($data->get('member.privatePhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                            </div>
                        <?php elseif($data->get('member.idPhotoFilePathForClientShow') != asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') != asset('/img/client/student-search/samplestudent04.jpg')): ?>
                            <div class="slick-slide">
                                <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                            </div>
                            <div class="slick-slide">
                                <img src="<?php echo e($data->get('member.privatePhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="shi">
                    <h3>
                        <?php echo e($data->get('member.lastName')); ?>　<?php echo e($data->get('member.firstName')); ?>

                        <span>
                            （
                            <?php echo e($data->get('member.lastNameKana')); ?>　<?php echo e($data->get('member.firstNameKana')); ?>

                            <?php if($data->get('member.country') > 1 && $data->get('member.englishName') != ''): ?>
                                ／ <?php echo e($data->get('member.englishName')); ?>

                            <?php endif; ?>
                            ）
                        </span>
                    </h3>
                    <p><?php echo e($data->get('member.age').'歳'); ?>／<?php echo e($data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')); ?><?php echo e($data->get('member.oldSchool.alreadyGraduated')? '卒業':'卒業予定'); ?></p>
                    <p><?php echo e($data->get('member.oldSchool.name')); ?>／<?php echo e($data->get('member.oldSchool.departmentName')); ?></p>
                </div>
            </div>

            <div class="full_width">
                <div class="half_width">
                    <div class="student_profile_image web_view">
                        <div class="selected_image">
                            <?php if($data->get('member.idPhotoFilePathForClientShow') == asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') == asset('/img/client/student-search/samplestudent04.jpg')): ?>
                                <div>
                                    <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                                </div>
                            <?php else: ?>
                                <?php if($data->get('member.idPhotoFilePathForClientShow') != asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') == asset('/img/client/student-search/samplestudent04.jpg')): ?>
                                    <div>
                                        <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                                    </div>
                                <?php elseif($data->get('member.idPhotoFilePathForClientShow') == asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') != asset('/img/client/student-search/samplestudent04.jpg')): ?>
                                    <div>
                                        <img src="<?php echo e($data->get('member.privatePhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                                    </div>
                                <?php elseif($data->get('member.idPhotoFilePathForClientShow') != asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') != asset('/img/client/student-search/samplestudent04.jpg')): ?>
                                    <div>
                                        <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                                    </div>
                                    <div>
                                        <img src="<?php echo e($data->get('member.privatePhotoFilePathForClientShow')); ?>" alt="証明写真" class="large" data-lity>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <div class="half_width">
                    <div class="member_intro">
                        <h2>自己PR</h2>
                        <p>
                            <?php echo nl2br($data->get('member.introduction')); ?>

                        </p>
                        <div class="hash_tags">
                            <?php if(!empty($data->get('member.hashTag'))): ?>
                                <span class="tag <?php echo e($data->get('member.hashTag.color')? \App\Domain\Entities\Tag::TAG_COLLAR_CLASS_LIST[$data->get('member.hashTag.color')]:''); ?>"><?php echo e($data->get('member.hashTag.name')); ?></span>
                            <?php endif; ?>
                            <?php if($data->get('member.internNeeded') === true): ?>
                                <span class="intern">インターン希望</span>
                            <?php endif; ?>
                        </div>
                        <ul class="student-type">
                            <?php if($data->get('member.affiliationExperience')): ?>
                                <li>体育会系経験あり</li>
                            <?php endif; ?>
                            <?php if($data->get('member.instagramFollowerNumber') && ($data->get('member.instagramFollowerNumber') !== \App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_OTHER)): ?>
                                <li>インスタフォロワー<?php echo e(\App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_LABEL_LIST[$data->get('member.instagramFollowerNumber')]); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="scroll_position"></div> <!--very important-->
            <?php $__currentLoopData = $data->get('prVideos'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="full_width">
                    <div class="half_width">
                        <div class="member_video_or_image">
                            <?php if(preg_match('/\.(png|jpeg|jpg)$/i', $prVideo['prVideoPath'])): ?>
                                <img src="<?php echo e($prVideo['prVideoPath']); ?>" alt="" data-lity>
                                <p>※ 写真をクリックすると拡大されます。</p>
                            <?php else: ?>
                                <video controlsList="nodownload" class="pr__movie" controls="controls" muted="muted" poster="" playsinline="" data-lity>
                                    <source src="<?php echo e($prVideo['prVideoPath']); ?>">
                                    <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                </video>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="half_width">
                        <div class="image_video_description">
                            <h3><?php echo e($prVideo['title']); ?></h3>
                            <p><?php echo nl2br($prVideo['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="member_details">
                <h2>プロフィール紹介</h2>

                <div class="full_width">
                    <div class="one_third_width"><p>氏名</p></div>
                    <div class="two_third_width">
                        <?php echo e($data->get('member.lastName')); ?>　<?php echo e($data->get('member.firstName')); ?>（<?php echo e($data->get('member.lastNameKana')); ?>　<?php echo e($data->get('member.firstNameKana')); ?>）
                        <?php if($data->get('member.country') > 1): ?>
                            <br><?php echo e($data->get('member.englishName')); ?>

                        <?php endif; ?>
                    </div>

                    <div class="one_third_width"><p>生年月日</p></div>
                    <div class="two_third_width"><?php echo e($data->getWithFormat('member.birthday','Y年n月j日')); ?>（<?php echo e($data->get('member.age').'歳'); ?>）</div>

                    <div class="one_third_width"><p>国籍</p></div>
                    <div class="two_third_width">
                        <?php if($data->get('member.country') > 1): ?>
                            <?php echo e(\App\Domain\Entities\Member::CITIZENSHIP_OVERSEAS_LIST[$data->get('member.country')]); ?>

                        <?php else: ?>
                            <?php echo e('日本'); ?>

                        <?php endif; ?>
                    </div>

                    <div class="one_third_width"><p>現住所</p></div>
                    <div class="two_third_width">
                        <?php if($data->get('member.country') > 1): ?>
                            <?php echo e($data->get('member.city')); ?>

                        <?php else: ?>
                            <?php echo e($data->get('member.addressString')); ?>

                        <?php endif; ?>
                    </div>

                    <div class="one_third_width"><p>学校種別</p></div>
                    <div class="two_third_width"><?php echo e(\App\Domain\Entities\School::SCHOOL_TYPE_LIST[$data->get('member.oldSchool.schoolType')]); ?></div>

                    <div class="one_third_width"><p>学校情報</p></div>
                    <div class="two_third_width"><?php echo e($data->get('member.oldSchool.name')); ?><br><?php echo e($data->get('member.oldSchool.departmentName')); ?></div>

                    <?php if($data->get('member.country') == 1): ?>
                        <div class="one_third_width"><p>学部系統</p></div>
                        <div class="two_third_width"><?php echo e(isset(\App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]) ? \App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')] : \App\Domain\Entities\School::OVERSEAS_FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]); ?></div>
                    <?php endif; ?>

                    <div class="one_third_width"><p>卒業年月</p></div>
                    <div class="two_third_width"><?php echo e($data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')); ?></div>

                    <?php if(!empty($data->get('member.careers')) && count(($data->get('member.careers')))>0): ?>
                        <div class="one_third_width"><p>経歴</p></div>
                        <div class="two_third_width">
                            <ul>
                                <?php $__currentLoopData = $data->get('member.careers'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $careers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($careers->getWithFormat('period','Y年n月')); ?><br><?php echo e($careers->get('name')); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($data->get('member.aspirationSelfIntroductions'))): ?>
                        <?php $__currentLoopData = $data->get('member.aspirationSelfIntroductions'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selfIntroduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="one_third_width"><p><?php echo e($selfIntroduction->get('title')); ?></p></div>
                            <div class="two_third_width"><?php echo nl2br($selfIntroduction->get('content')); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if(!empty($data->get('member.aspirationBusinessTypes')) && count(($data->get('member.aspirationBusinessTypes')))>0): ?>
                        <div class="one_third_width"><p>志望業種</p></div>
                        <div class="two_third_width">
                            <?php $__currentLoopData = $data->get('member.aspirationBusinessTypes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aspirationBusinessType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($key===0? '':'/ '); ?><?php echo e($aspirationBusinessType->get('name')); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($data->get('member.aspirationJobTypes')) && count(($data->get('member.aspirationJobTypes')))>0): ?>
                        <div class="one_third_width"><p>志望職種</p></div>
                        <div class="two_third_width">
                            <?php $__currentLoopData = $data->get('member.aspirationJobTypes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aspirationJobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($key===0? '':'/ '); ?><?php echo e($aspirationJobType->get('name')); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($data->get('member.aspirationPrefectures')) && count(($data->get('member.aspirationPrefectures')))>0): ?>
                        <div class="one_third_width"><p>志望勤務地</p></div>
                        <div class="two_third_width">
                            <?php $__currentLoopData = $data->get('member.aspirationPrefectures'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aspirationPrefectures): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($key===0? '':'/ '); ?><?php echo e($aspirationPrefectures->get('name')); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($data->get('member.languageAndCertification')) &&(($data->get('member.languageAndCertification.toeicScore')||$data->get('member.languageAndCertification.toeflScore'))||(!empty($data->get('member.languageAndCertification.certifications')) && count(($data->get('member.languageAndCertification.certifications')))>0))): ?>
                        <div class="one_third_width"><p>語学・資格</p></div>
                        <div class="two_third_width">
                            <?php if(($data->get('member.languageAndCertification.toeicScore')||$data->get('member.languageAndCertification.toeflScore'))): ?>
                                <ol>
                                    <?php if($data->get('member.languageAndCertification.toeicScore')): ?>
                                        <li>
                                            TOEIC <?php echo e($data->get('member.languageAndCertification.toeicScore')); ?>点
                                        </li>
                                    <?php endif; ?>
                                    <?php if($data->get('member.languageAndCertification.toeflScore')): ?>
                                        <li>
                                            TOEFL <?php echo e($data->get('member.languageAndCertification.toeflScore')); ?>点
                                        </li>
                                    <?php endif; ?>
                                </ol>
                            <?php endif; ?>
                            <?php if(!empty($data->get('member.languageAndCertification.certifications')) && count(($data->get('member.languageAndCertification.certifications')))>0): ?>
                                <ol>
                                    <?php $__currentLoopData = $data->get('member.languageAndCertification.certifications'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $certifications): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <?php echo e($certifications->get('name')); ?>

                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
        
        <div id="student_scroll_profile">
            <div class="profile_link web_view">
                <p>この学生の</p>
                <p>プロフィールを見る</p>
                <img src="<?php echo e(asset('img/client/student-search/address-card-regular.svg')); ?>" alt="">
            </div>
            <div class="hidden_profile_image web_view">
                <i class="fa fa-times" aria-hidden="true"></i>
                <?php if($data->get('member.idPhotoFilePathForClientShow') == asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') == asset('/img/client/student-search/samplestudent04.jpg')): ?>
                    <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large">
                <?php else: ?>
                    <?php if($data->get('member.idPhotoFilePathForClientShow') != asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') == asset('/img/client/student-search/samplestudent04.jpg')): ?>
                        <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large">
                    <?php elseif($data->get('member.idPhotoFilePathForClientShow') == asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') != asset('/img/client/student-search/samplestudent04.jpg')): ?>
                        <img src="<?php echo e($data->get('member.privatePhotoFilePathForClientShow')); ?>" alt="証明写真" class="large">
                    <?php elseif($data->get('member.idPhotoFilePathForClientShow') != asset('img/mypage/profile/img_self.png') && $data->get('member.privatePhotoFilePathForClientShow') != asset('/img/client/student-search/samplestudent04.jpg')): ?>
                        <img src="<?php echo e($data->get('member.idPhotoFilePathForClientShow')); ?>" alt="証明写真" class="large">
                    <?php endif; ?>
                <?php endif; ?>

                <h2><?php echo e($data->get('member.lastName')); ?>　<?php echo e($data->get('member.firstName')); ?> <span><?php echo e($data->get('member.age').'歳'); ?></span></h2>
                <p>(<?php echo e($data->get('member.lastNameKana')); ?>　<?php echo e($data->get('member.firstNameKana')); ?>)</p>
                <?php if($data->get('member.country') > 1 && $data->get('member.englishName') != ''): ?>
                    <p>(<?php echo e($data->get('member.englishName')); ?>)</p>
                <?php endif; ?>
                <p><?php echo e($data->get('member.oldSchool.name')); ?></p>
                <p><?php echo e($data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')); ?><?php echo e($data->get('member.oldSchool.alreadyGraduated')? '卒業':'卒業予定'); ?></p>

            </div>
        </div>
        <div id="student_extension">
            
            <div class="fixed_tab">
                <form action="#">
                    <button type="submit">
                        <p>この学生に</p>
                        <p>メッセージする</p>
                        <img src="<?php echo e(asset('img/mypage/profile/preview/comment-dots-regular.svg')); ?>" alt="">
                    </button>
                </form>
                
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>