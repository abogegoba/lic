<?php if(empty($clientAuthentication)): ?>
    <section id="gnav">
        <div class="gnav__inner">
            <header>
                <h2 class="gnav__heading">MENU</h2>
                <button type="button" class="gnav__close"><strong>CLOSE</strong></button>
            </header>
            <ul class="gnav__menu">
                <li><a href="<?php echo e(route('client.login')); ?>">ログイン</a></li>
                <li><a href="<?php echo e(route('client.contact')); ?>">お問合せ</a></li>
                <li><a href="<?php echo e(route('client.news.list')); ?>">ニュース</a></li>
                <li><a href="<?php echo e(route('client.partner')); ?>">パートナー企業</a></li>
                <li><a href="/business/#qa" id="qaLink">よくある質問</a></li>
            </ul>
            <ul class="gnav__menu--sub">
                <li><a href="<?php echo e(route('client.static.use')); ?>" target="_blank">ご利用ガイド</a></li>
                <li><a href="<?php echo e(route('client.static.privacy')); ?>" target="_blank">個人情報保護方針</a></li>
                <li><a href="<?php echo e(route('client.static.personal')); ?>" target="_blank">取り扱いについて</a></li>
                <li><a href="https://in-fit.co.jp/" target="_blank">運営会社について</a></li>
            </ul>
            <ul class="gnav__menu">
                <li><a href="/">学生の方はこちら</a></li>
            </ul>
        </div>
    </section>
<?php else: ?>
    <section id="gnav" class="aft-login">
        <div class="gnav__inner">
            <header>
                <h2 class="gnav__heading">MENU</h2>
                <button type="button" class="gnav__close"><strong>CLOSE</strong></button>
            </header>
            <div class="gnav__menu__foot">
                <nav class="gnav__mypage"><a href="<?php echo e(route('client.company-edit.basic-information')); ?>">企業ページ</a></nav>
                <ul class="gnav__menu">
                    <li class="gnav__user-name"><?php echo e($clientAuthentication->get('companyName')); ?>　<?php echo e($clientAuthentication->get('lastName') . $clientAuthentication->get('firstName')); ?>様</li>
                    <li><a href="<?php echo e(route('client.student.list')); ?>">学生検索</a></li>
                    <li><a href="<?php echo e(route('client.message.list')); ?>">メッセージ</a></li>
                    <li><a href="<?php echo e(route('client.video-interview.list')); ?>">Web面接</a></li>
                    <li><a href="<?php echo e(route('client.company-edit.basic-information')); ?>">企業編集</a></li>
                    <li class="gnav__menu__logout"><a href="<?php echo e(route('client.logout')); ?>">ログアウト</a></li>
                </ul>
                <ul class="gnav__menu">
                    <li><a href="<?php echo e(route('client.contact')); ?>">お問合せ</a></li>
                    <li><a href="<?php echo e(route('client.news.list')); ?>">ニュース</a></li>
                    <li><a href="<?php echo e(route('client.partner')); ?>">パートナー企業</a></li>
                    <li><a href="/business/#qa" id="qaLink">よくある質問</a></li>
                </ul>
                <ul class="gnav__menu--sub">
                    <li><a href="<?php echo e(route('client.static.use')); ?>" target="_blank">ご利用ガイド</a></li>
                    <li><a href="<?php echo e(route('client.static.privacy')); ?>" target="_blank">個人情報保護方針</a></li>
                    <li><a href="<?php echo e(route('client.static.personal')); ?>" target="_blank">取り扱いについて</a></li>
                    <li><a href="https://in-fit.co.jp/" target="_blank">運営会社について</a></li>
                </ul>
                <ul class="gnav__menu">
                    <li><a href="/">学生の方はこちら</a></li>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>
