<header id="hdr" class="requid">
    <h1 id="hdr__logo"><a href="<?php echo e(route('client.top')); ?>"><img src="<?php echo e(asset('img/common/logo.png')); ?>" alt="次世代型新卒採用サービス：LinkT"></a></h1>
    <?php if(empty($clientAuthentication)): ?>
        <a id="hdr__anc" href="/"><span>学生の方はこちら</span></a>
    <?php endif; ?>
    <nav id="hdr__nav">
        <?php if(empty($clientAuthentication)): ?>
        <p>会員企業はこちら</p>
        <ul id="login_menu">
            <li><a href="<?php echo e(route('client.login')); ?>">ログイン</a></li>
        </ul>
        <?php else: ?>
        <ul id="notification">
            <li onclick="myFunction('msg_dropdown')">
                <a>
                    
                    <img src="<?php echo e(asset('img/common/comment-dots-regular.png')); ?>" alt="">
                    <span id="msg_ntfy" data-msg_count="0">0</span>
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

            </li>
        </ul>
        <?php endif; ?>
    </nav>
    <button id="hdr__button"><span></span><strong>MENU</strong></button>
</header>
