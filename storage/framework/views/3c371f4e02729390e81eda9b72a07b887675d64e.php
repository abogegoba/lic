<?php if(isset($memberAuthentication)): ?>
<nav id="mypageMenuNew">
    <ul>
        <li>
            <a href="<?php echo e(route('front.company.list')); ?>">
                <img src="<?php echo e(asset('/img/common/mypage/icon-search.png')); ?>" alt="">
            </a>
            <p>企業検索</p>
        </li>
        <li>
            <a href="<?php echo e(route('front.message.list')); ?>">
                <img src="<?php echo e(asset('/img/common/mypage/icon-message.png')); ?>" alt="">
            </a>
            <p>メッセージ</p>
        </li>
        <li>
            <a href="<?php echo e(route('front.video-interview.list')); ?>">
                <img src="<?php echo e(asset('/img/common/mypage/icon-video.png')); ?>" alt="">
            </a>
            <p>Web面接</p>
        </li>
        <li>
            <a href="<?php echo e(route('front.profile')); ?>">
                <img src="<?php echo e(asset('/img/common/mypage/icon-profile.png')); ?>" alt="">
            </a>
            <p>プロフィール</p>
        </li>
    </ul>
</nav>
<div id="drawer">
    <span class="up_down"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
</div>
<?php endif; ?>
