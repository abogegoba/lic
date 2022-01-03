<?php $__env->startSection('title','プロフィール詳細│マイページ｜LinkT(リンクト)'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/common.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mypage/profile/common.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="<?php echo e(route('front.top')); ?>">LINKT（リンクト） TOP</a></li>
            <li>マイページ</li>
        </ul>
    </nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('front.common.mypage_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="main__content" id="profile">
        <h2 class="main__content__headline">プロフィール</h2>
        <div class="form__preview">
            <div class="form__controls">
                <input type="button" value="登録内容でプレビュー" class="preview js-btn-target-blank" data-href="<?php echo e(route('front.profile.preview')); ?>">
            </div>
        </div>
        <form action="<?php echo e(route('front.profile.personal.edit')); ?>" class="form__modify">
            <dl>
                <dt>氏名</dt>
                <dd><?php echo e($data->get('member.lastName')); ?>　<?php echo e($data->get('member.firstName')); ?>

                    （<?php echo e($data->get('member.lastNameKana')); ?>　<?php echo e($data->get('member.firstNameKana')); ?>）
                </dd>
                <?php if($data->get('member.country') > 1): ?>
                <dt>English Name</dt>
                <dd><?php echo e($data->get('member.englishName')); ?></dd>
                <?php endif; ?>
                <dt>生年月日</dt>
                <dd><?php echo e($data->getWithFormat('member.birthday','Y年n月j日')); ?></dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.address.edit')); ?>" class="form__modify">
            <dl>
                <?php if($data->get('member.country') > 1): ?>
                <dt>国籍</dt>
                <dd><?php echo e(\App\Domain\Entities\Member::CITIZENSHIP_OVERSEAS_LIST[$data->get('member.country')]); ?></dd>
                <?php endif; ?>
                <dt>現住所</dt>
                <dd>
                    <?php if($data->get('member.country') > 1): ?>
                        <?php echo e($data->get('member.city')); ?>

                    <?php else: ?>
                        <?php echo e($data->get('member.addressString')); ?>

                    <?php endif; ?>

                    <?php if($data->get('member.blockNumber')): ?>
                        <br><?php echo e($data->get('member.blockNumber')); ?>

                    <?php endif; ?>
                </dd>
                <dt>連絡先</dt>
                <dd><?php echo e($data->get('member.phoneNumber')); ?></dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.school.edit')); ?>" class="form__modify">
            <dl>
                <dt>学校情報</dt>
                <dd><?php echo e(\App\Domain\Entities\School::SCHOOL_TYPE_LIST[$data->get('member.oldSchool.schoolType')]); ?>

                    <?php if($data->get('member.country') == 1): ?>
                    ／<?php echo e(isset(\App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]) ? \App\Domain\Entities\School::FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')] : \App\Domain\Entities\School::OVERSEAS_FACULTY_TYPE_LIST[$data->get('member.oldSchool.facultyType')]); ?>

                    <?php endif; ?>
                    <br><?php echo e($data->get('member.oldSchool.name')); ?>

                    <br><?php echo e($data->get('member.oldSchool.departmentName')); ?>

                    <br><?php echo e($data->getWithFormat('member.oldSchool.graduationPeriod','Y年n月')); ?><?php echo e($data->get('member.oldSchool.alreadyGraduated')? '卒業':'卒業予定'); ?>

                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.photo.edit')); ?>" class="form__modify">
            <dl>
                <dt>写真・ハッシュタグ</dt>
                <dd>
                    <div class="flex">
                        <section>
                            <h2>証明写真</h2>
                            <picture>
                                <img src="<?php echo e($data->get('member.idPhotoFilePathForFrontShow')); ?>" alt="証明写真">
                            </picture>
                        </section>
                        <section>
                            <h2>プライベート写真</h2>
                            <picture>
                                <img src="<?php echo e($data->get('member.privatePhotoFilePathForFrontShow')); ?>" alt="プライベート写真">
                            </picture>
                        </section>
                    </div>
                    <h2>ハッシュタグ</h2>
                    <ul>
                        <?php if(!empty($data->get('member.hashTag'))): ?>
                            <li class="tag <?php echo e($data->get('member.hashTag.color')? \App\Domain\Entities\Tag::TAG_COLLAR_CLASS_LIST[$data->get('member.hashTag.color')]:''); ?>"><?php echo e($data->get('member.hashTag.name')); ?></li>
                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </ul>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.pr.edit')); ?>" class="form__modify">
            <dl>
                <dt>PR</dt>
                <dd>
                    <h2>PR動画</h2>
                    <?php if(!empty($data->get('prVideos')) && count($data->get('prVideos')) >0): ?>
                        <?php $__currentLoopData = $data->get('prVideos'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prVideo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <section>
                                <h3><?php echo e($prVideo->get('title')); ?></h3>
                                <div class="content">
                                    <?php if(preg_match('/\.(png|jpeg|jpg)$/i', $prVideo->get("url"))): ?>
                                        <picture>
                                            <img src="<?php echo e($prVideo->get("url")); ?>" alt="">
                                        </picture>
                                    <?php else: ?>
                                        <div class="video">
                                            <video controlsList="nodownload" controls="controls" muted="muted" poster="">
                                                <source src="<?php echo e($prVideo->get('url')); ?>">
                                                <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
                                            </video>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p><?php echo nl2br($prVideo->get('description')); ?></p>
                            </section>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        未登録
                    <?php endif; ?>
                    <h2>自己PR文</h2>
                    <p>
                        <?php if(!empty($data->get('member.introduction'))): ?>
                            <?php echo nl2br($data->get('member.introduction')); ?>

                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </p>
                    <?php if($data->get('member.country') == 1): ?>
                    <h2>体育会所属経験</h2>
                    <p>
                        <?php if($data->get('member.affiliationExperience') !== null): ?>
                            <?php echo e(\App\Domain\Entities\Member::AFFILIATION_EXPERIENCE_LABEL_LIST[$data->get('member.affiliationExperience')]); ?>

                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </p>
                    <?php endif; ?>
                    <h2>インスタフォロワー数</h2>
                    <p>
                        <?php if($data->get('member.instagramFollowerNumber')): ?>
                            <?php echo e(\App\Domain\Entities\Member::INSTAGRAM_FOLLOWER_NUMBER_LABEL_LIST[$data->get('member.instagramFollowerNumber')]); ?>

                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </p>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.self-introduction.edit')); ?>" class="form__modify">
            <dl>
                <dt>自己紹介</dt>
                <dd>
                    <?php $__currentLoopData = $data->get("selfIntroductions"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $displayNumber => $selfIntroductions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h2>
                            <?php echo e($selfIntroductions['title']); ?>

                        </h2>
                        <p><?php echo nl2br($selfIntroductions['content']); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.desired.edit')); ?>" class="form__modify">
            <dl>
                <dt>志望情報</dt>
                <dd>
                    <h2>志望業種</h2>
                    <p>
                        <?php if(!empty($data->get('member.aspirationBusinessTypes')) && count(($data->get('member.aspirationBusinessTypes')))>0): ?>
                            <?php $__currentLoopData = $data->get('member.aspirationBusinessTypes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aspirationBusinessType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($key===0? '':'/ '); ?><?php echo e($aspirationBusinessType->get('name')); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </p>
                    <h2>志望職種</h2>
                    <p>
                        <?php if(!empty($data->get('member.aspirationJobTypes')) && count(($data->get('member.aspirationJobTypes')))>0): ?>
                            <?php $__currentLoopData = $data->get('member.aspirationJobTypes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aspirationJobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($key===0? '':'/ '); ?><?php echo e($aspirationJobType->get('name')); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </p>
                    <h2>志望勤務地</h2>
                    <p>
                        <?php if(!empty($data->get('member.aspirationPrefectures')) && count(($data->get('member.aspirationPrefectures')))>0): ?>
                            <?php $__currentLoopData = $data->get('member.aspirationPrefectures'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aspirationPrefectures): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($key===0? '':'/ '); ?><?php echo e($aspirationPrefectures->get('name')); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </p>
                    <h2>インターン</h2>
                    <p><?php echo e($data->get('member.internNeeded') === true? '希望する':'希望しない'); ?></p>
                    <h2>就活イベントやその他就職活動に関する情報取得について</h2>
                    <p><?php echo e($data->get('member.recruitInfoNeeded') === true? '希望する':'希望しない'); ?></p>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.language.edit')); ?>" class="form__modify">
            <dl>
                <dt>語学・資格</dt>
                <dd>
                    <h2>語学</h2>
                    <p>
                        TOEIC　　<?php echo e(!empty($data->get('member.languageAndCertification')) && !empty($data->get('member.languageAndCertification.toeicScore'))? $data->get('member.languageAndCertification.toeicScore').'点':'未登録'); ?>

                        <br>
                        TOEFL　　<?php echo e(!empty($data->get('member.languageAndCertification')) && !empty($data->get('member.languageAndCertification.toeflScore'))? $data->get('member.languageAndCertification.toeflScore').'点':'未登録'); ?>

                    </p>
                    <h2>保有資格・検定など</h2>
                    <ul>
                        <?php if(!empty($data->get('member.languageAndCertification.certifications')) && count(($data->get('member.languageAndCertification.certifications')))>0): ?>
                            <?php $__currentLoopData = $data->get('member.languageAndCertification.certifications'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $certifications): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>

                                    <?php echo e($certifications->get('name')); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            未登録
                        <?php endif; ?>
                    </ul>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.career.edit')); ?>" class="form__modify">
            <dl>
                <dt>経歴</dt>
                <dd>
                    <?php if(!empty($data->get('member.careers')) && count(($data->get('member.careers')))>0): ?>
                        <?php $__currentLoopData = $data->get('member.careers'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $careers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($careers->getWithFormat('period','Y年n月')); ?><br>
                                <?php echo e($careers->get('name')); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        未登録
                    <?php endif; ?>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <form action="<?php echo e(route('front.profile.id-and-pass.edit')); ?>" class="form__modify">
            <dl>
                <dt>ID・パスワード</dt>
                <dd>
                    <p><?php echo e($data->get('member.userAccount.mailAddress')); ?></p>
                    <ul class="notice">
                        <li>※メールアドレスをパスワードとして利用します</li>
                        <li>※パスワードはご入力いただいたものです。</li>
                        <li>(セキュリティの観点より本画面では非表示です。）</li>
                    </ul>
                </dd>
            </dl>
            <button type="submit" class="button">修正</button>
        </form>
        <div class="form__preview">
            <div class="form__controls">
                <input type="button" value="登録内容でプレビュー" class="preview js-btn-target-blank" data-href="<?php echo e(route('front.profile.preview')); ?>">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.common.root', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>