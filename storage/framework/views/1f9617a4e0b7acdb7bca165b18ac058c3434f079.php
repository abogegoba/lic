<?php if(empty($memberAuthentication)): ?>
    <section id="gnav">
        <div class="gnav__inner">
            <header>
                <h2 class="gnav__heading">MENU</h2>
                <button type="button" class="gnav__close"><strong>CLOSE</strong></button>
            </header>
            <ul class="gnav__menu">
                <li><a href="<?php echo e(route('front.top')); ?>">トップページ</a></li>
                <li><a href="<?php echo e(route('front.static.select_entry')); ?>">会員登録</a></li>
                <li><a href="<?php echo e(route('front.member.login')); ?>">ログイン</a></li>
                <li><a href="<?php echo e(route('front.company.list')); ?>">企業検索</a></li>
                <li><a href="<?php echo e(route('front.news.list')); ?>">ニュース</a></li>
                <li><a href="<?php echo e(route('front.partner')); ?>">パートナー企業</a></li>
                <li><a href="<?php echo e(route('front.static.about')); ?>#qa" id="qaLink">よくある質問</a></li>

            </ul>
            <ul class="gnav__menu--sub">
                <li><a href="<?php echo e(route('front.static.about')); ?>" target="_blank">ご利用ガイド</a></li>
                <li><a href="<?php echo e(route('front.static.privacy')); ?>" target="_blank">個人情報保護方針</a></li>
                <li><a href="<?php echo e(route('front.static.term')); ?>" target="_blank">利用規約</a></li>
                <li><a href="<?php echo e(route('front.static.personal')); ?>" target="_blank">取り扱いについて</a></li>
                <li><a href="https://in-fit.co.jp/" target="_blank">運営会社について</a></li>
            </ul>
            <ul class="gnav__menu">
                <li><a href="/business/">企業の方はこちら</a></li>
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
            <ul class="gnav__menu">
                <li><a href="<?php echo e(route('front.top')); ?>">トップページ</a></li>
                <li><a href="<?php echo e(route('front.company.list')); ?>">企業検索</a></li>
                <li><a href="<?php echo e(route('front.news.list')); ?>">ニュース</a></li>
                <li><a href="<?php echo e(route('front.partner')); ?>">パートナー企業</a></li>
                <li><a href="<?php echo e(route('front.static.about')); ?>#qa" id="qaLink">よくある質問</a></li>

            </ul>
            <div class="gnav__menu__foot">
                <nav class="gnav__mypage"><a href="<?php echo e(route('front.company.list')); ?>">マイページ</a></nav>
                <ul class="gnav__menu">
                    <li class="gnav__user-name">こんにちは。<?php echo e($memberAuthentication->get("lastName") . $memberAuthentication->get("firstName")); ?>さん</li>
                    <li><a href="<?php echo e(route('front.message.list')); ?>">メッセージ</a></li>
                    <li><a href="<?php echo e(route('front.video-interview.list')); ?>">Web面接</a></li>
                    <li><a href="<?php echo e(route('front.profile')); ?>">プロフィール編集</a></li>
                    <li class="gnav__menu__logout"><a href="<?php echo e(route('front.member.logout')); ?>">ログアウト</a></li>
                </ul>
                <ul class="gnav__menu--sub">
                    <li><a href="<?php echo e(route('front.static.about')); ?>" target="_blank">ご利用ガイド</a></li>
                    <li><a href="<?php echo e(route('front.static.privacy')); ?>" target="_blank">個人情報保護方針</a></li>
                    <li><a href="<?php echo e(route('front.static.term')); ?>" target="_blank">利用規約</a></li>
                    <li><a href="<?php echo e(route('front.static.personal')); ?>" target="_blank">取り扱いについて</a></li>
                    <li><a href="https://in-fit.co.jp/" target="_blank">運営会社について</a></li>
                </ul>
                <ul class="gnav__menu">
                    <li><a href="/business/">企業の方はこちら</a></li>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>
