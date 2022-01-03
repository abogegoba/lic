<header id="hdr" class="requid">
    <h1 id="hdr__logo"><a href="<?php echo e(route('front.top')); ?>"><img src="<?php echo e(asset('img/common/logo.png')); ?>" alt="次世代型就活サイト：LinkT"></a></h1>
    <?php if(empty($memberAuthentication)): ?>
    <a id="hdr__anc" href="/business/"><span>企業様はこちら</span></a>
    <?php endif; ?>
    <nav id="hdr__nav">
        <?php if(empty($memberAuthentication)): ?>
        <ul id="login_menu">
            <li><a href="<?php echo e(route('front.member.login')); ?>">ログイン</a></li>
            <li><a href="<?php echo e(route('front.static.select_entry')); ?>">会員登録</a></li>
        </ul>
        <?php else: ?>
        <ul id="notification">
            <li onclick="myFunction('msg_dropdown')">
                <a>
                    
                    <img src="<?php echo e(asset('img/common/comment-dots-regular.png')); ?>" alt="">
                    <span id="msg_ntfy" data-msg_count="0">0</span>
                </a>
            </li>
            <li onclick="myFunction('like_dropdown')">
                <a>
                    
                    <img src="<?php echo e(asset('img/common/bell-regular.png')); ?>" alt="">
                    <span id="like_ntfy" data-like_count="0">0</span>
                </a>
                <!-- dropdown menu-->
                <div class="notification_dropdown" id="msg_dropdown">
                    
                    <div>
                        <button type="button" class="gnav__close"></button>
                        <p><b class="notification_title">メッセージ</b></p>
                        <ul id="notification_msg_list">
                            <p id="empty_msg_notice">メッセージがありません。</p>
                        </ul>
                    </div>
                </div>
                <!-- dropdown menu-->
                <div class="notification_dropdown" id="like_dropdown">
                    
                    <div>
                        <button type="button" class="gnav__close"></button>
                        <p><b class="notification_title">お知らせ</b></p>
                        <ul id="notification_like_list">
                            <p id="empty_like_notice">お知らせがありません。</p>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <?php endif; ?>
    </nav>
    <button id="hdr__button"><span></span><strong>MENU</strong></button>
</header>
