@extends('front.common.root')

@section('description','新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】の学生向けサービス説明ページです。学生の就職活動における悩みをLinkTを使えばどのように解決できるのか、また、利用の流れや、よくある質問とその回答について記載しています。')

@section('title','LinkT（リンクト）とは ｜次世代の就活ならLinkT(リンクト)')

@section('css')
    <link rel="stylesheet" href="{{asset('css/about/index.css')}}">
@stop

@section('js')
    <script>
        $(function(){
            url = window.location.toString();
            anc = url.substring(url.search('#') + 1);
            
            if(anc){
                var Hash = $("#"+anc);
                var HashOffset = $(Hash).offset().top;
                jQuery("html,body").animate({
                    scrollTop: HashOffset
                }, 500);
            }
        });
        //リンクをクリックしたら、メニューを閉じる
        $("#qaLink").on("click", function() {
            $('#gnav').hide();
        });
        // 親メニュー処理
        $('#qa__list--open').on("click", function() {
            // メニュー表示/非表示
            $(this).toggleClass('main__close').next('dl').slideToggle();
        });
        // 子メニュー処理
        $('.main__qa--more-qa').on("click",function(e) {
            // メニュー表示/非表示
            $(this).toggleClass('close').next('dd').slideToggle();
            e.stopPropagation();
        });


    </script>

@stop

@section('breadcrumbs')
    <nav id="breadcrumbs" class="requid">
        <ul>
            <li><a href="{{route('front.top')}}">LINKT（リンクト） TOP</a></li>
            <li>LinkTについて</li>
        </ul>
    </nav>
@stop

@section('content')
    <section class="main__catch requid">
        <h2 class="headline--xlarge">就活は、LinkT</h2>
        <p>動画とオンライン面接を使って就活をもっと充実させる</p>
        <div class="navBk">
            @if(!isset($memberAuthentication))
                <a href="{{route("front.static.select_entry")}}">会員登録</a>
            @endif
            <a href="{{route('front.static.describe')}}">使い方はこちら</a>
        </div>
        <p>LinkTは就活性が抱える悩みを解決し、<br>就活を成功へ導きます。</p>
    </section>
    <section class="main__summary fullWidth">
        <picture>
            <source media="(max-width: 767px)" srcset={{asset("img/about/img_trouble-sp.jpg")}}>
            <img src="{{asset("img/about/img_trouble-pc.jpg")}}" alt="LinkTで解決">
        </picture>
        <div class="summary__nav">
            <h2 class="headline--small">LinkTで解決</h2>
            <div>
                @if(!isset($memberAuthentication))
                    <a href="{{route("front.static.select_entry")}}">会員登録</a>
                @endif
                <a href="{{route('front.static.describe')}}">使い方はこちら</a>
            </div>
        </div>
    </section>
    <section class="main__content">
        <section class="main__content__feature">
            <h2 class="headline--small">LinkTの特徴</h2>
            <dl>
                <div>
                    <dt>企業情報が豊富</dt>
                    <dd>希望する条件に該当する企業のオリジナル動画や写真を閲覧することができるため、会社説明会に行かなくても企業探しが可能になります。</dd>
                </div>
                <div>
                    <dt>離れた場所から<br>面接ができる</dt>
                    <dd>面接をサイト内のオンライン面接で行うことができるため、金銭的負担が一切かかりません</dd>
                </div>
                <div>
                    <dt>エントリーシートで<br>落選することがなくなる</dt>
                    <dd>登録時に自己PR動画やプロフィールを掲載するため、あなたの情報を見た人事担当者からメッセージが届いたり、自分から気になる会社にメッセージを送ることができます。</dd>
                </div>
                <div>
                    <dt>就活の質があがる</dt>
                    <dd>LinkTに登録をした瞬間からあなたの存在を全国の企業にアピールできます。双方向のコミュニケーションを可能にすることで就活の質があがります。</dd>
                </div>
            </dl>
        </section>
        <section class="main__content__flow">
            <h2 class="headline--small">利用の流れ</h2>
            <ol>
                <li><span>STEP1</span>企業検索</li>
                <li><span>STEP2</span>メッセージ</li>
                <li><span>STEP3</span>オンライン面接</li>
                <li><span>STEP4</span>結果通知<small>(メッセージ内)</small></li>
            </ol>
        </section>
        @if(empty($memberAuthentication))
        <section class="main__content__qa" id="qa">
            <h2 class="headline--small">よくあるご質問</h2>
            <dl>
                <dt class="main__qa">ログインIDを忘れた場合は？</dt>
                <dd class="main__ans"><p><a href="{{route("front.contact")}}" class="link">お問い合わせフォーム</a>よりLinkT運営事務局にお問い合わせください。<br>※ログインIDは会員登録時に使用したメールアドレスになります。</p></dd>
                <dt class="main__qa">ログインパスワードを忘れた場合は？</dt>
                <dd class="main__ans"><p><a href="{{route("front.contact")}}" class="link">お問い合わせフォーム</a>よりLinkT運営事務局にお問い合わせください。</p></dd>
                <dt class="main__qa">ログインができないのですが？</dt>
                <dd class="main__ans"><div><p>本登録はお済みですか？</p><p><a href="{{route("front.static.select_entry")}}" class="link">会員登録ページ</a>から仮会員登録を完了させると登録したメールアドレス宛に本登録手続きのメールが届きますので、メール本文中のURLをタップして本登録を完了すればご利用が可能になります。<br>再度、<a href="{{route("front.member.login")}}" class="link">ログインページ</a>でログインIDとパスワードを入力し、ログインしてください。<br>※本登録が完了していない場合はログインIDとパスワードを入力してもログインができないのでご注意ください。</p></div></dd>
            </dl>
            <h2 class="headline main__qa--more" id="qa__list--open">質問をもっと見る</h2>
            <dl class="qa__list">
                    <dt class="main__qa--more-qa">会員登録の仕方について教えてください。</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><div><p><a href="{{route("front.static.select_entry")}}" class="link">会員登録ページ</a>から仮会員登録を完了させてください。</p><p>登録したメールアドレス宛に本登録手続きのメールが届きますので、メール本文中のURLをタップして本登録を完了すればご利用が可能になります。</p><p><a href="{{route("front.member.login")}}" class="link">ログインページ</a>からログインしてご利用を開始してください。<br>※本登録が完了していない場合はログインIDとパスワードを入力してもログインができないのでご注意ください。</p></div></div></dd>
                    <dt class="main__qa--more-qa">LinkTの基本的な使い方について教えてください。</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><div><p>まずは、<a href="{{route("front.static.select_entry")}}" class="link">会員登録ページ</a>から仮会員登録を完了させてください。</p><p>登録したメールアドレス宛に本登録手続きのメールが届きますのでメール本文中のURLをタップして本登録を完了すればご利用が可能になります。</p><p><a href="{{route("front.member.login")}}" class="link">ログインページ</a>からログインし、</p><p>《プロフィール編集》よりあなたの履歴書を完成させてください。</p><p>《企業検索》からご希望の条件を絞って企業を検索し、企業ページ中の</p><p>《面接依頼または質問をする》ボタンをタップして採用担当者と直接メッセージのやり取りを行うことができます。<p></p>Web面接を行う場合は、企業より送られるWeb面接予約をタップしてWeb面接ルームに入室をし、《接続する》ボタンをタップし面接を開始してください。</p><p>※Web面接ルーム入室前に、利用可能なブラウザのチェックボックスにチェックを入れてください面接結果はメッセージ画面に届きます。その後は企業の指示に従ってください。</p></div></div></dd>
                    <dt class="main__qa--more-qa">企業からオファーはきますか？</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><p>あなたのWeb履歴書を見て、あなたに魅力を感じた企業の採用担当者からメッセージが届きます。</p></div></dd>
                    <dt class="main__qa--more-qa">Web面接の仕方がわからないのですが。</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><div><p>ログイン後メニュー中の《Web面接》から、<a href="{{route("front.video-interview.list")}}" class="link">面接予約一覧</a>より予約内容を確認してください。</p><p>面接日時になりましたら、利用可能なブラウザのチェックボックスにチェックを入れ、</p><p>《Web面接ルームへ》をタップして入室し、面接時間になったら</p><p>《接続する》をタップして面接を開始してください。</p></div></div></dd>
                    <dt class="main__qa--more-qa">面接結果はどのようにして通知されますか？</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><div><p>メッセージにて合否連絡が届きます。</p><p>その後の動きについては、企業の指示に従ってください。</p><div></div></dd>
                    <dt class="main__qa--more-qa">面接をキャンセルしたいのですが。</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><p>ログイン後、メニュー中の《Web面接》から、<a href="{{route("front.video-interview.list")}}" class="link">面接予約一覧</a>をタップし、キャンセルを行ってください。</p></div></dd>
                    <dt class="main__qa--more-qa">Web面接は必須ですか？</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><div><p>Web面接は必須ではありません。</p><p>企業によってはWeb面接を必要としない場合もございます。</p></div></div></dd>
                    <dt class="main__qa--more-qa">Web履歴書の作り方がわからないのですが。</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><p><a href="{{route("front.static.describe")}}" class="link">LinkTの使い方</a>をご覧ください。</p></div></dd>
                    <dt class="main__qa--more-qa">利用料金は無料ですか？</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><p>完全無料です。</p></div></dd>
                    <dt class="main__qa--more-qa">インターン選考も受け付けてますか？</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><div><p>受け付けております。</p><p>インターンタグがついている企業はインターン選考を実施していますので、</p><p>積極的にコンタクトをとってください。</p></div></div></dd>
                    <dt class="main__qa--more-qa">利用・登録できる学生の対象はありますか？</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><p>大学、大学院、短大、高専、専門学校の学生の方、大学卒業後2年以内の方が対象となっております。</p></div></dd>
                    <dt class="main__qa--more-qa">自分の履歴書が他の学生に見られることはありますか？</dt>
                    <dd class="main__qa--more-ans"><div class="ans__box"><div><p>あなたの履歴書が他の学生に見られることはありませんのでご安心ください。</p><p>あなたの履歴書を見ることができるのは、個人情報保護方針に基づきLinkTと契約を交わし登録を完了させた企業の採用担当のみとなっております。</p></div></div></dd>
                </dl>
            </dl>
        </section>
        @else
        <section class="main__content__qa" id="qa">
            <h2 class="headline--small">よくあるご質問</h2>
            <dl>
                <dt class="main__qa">LinkTの基本的な使い方について教えてください。</dt>
                <dd class="main__ans"><div><p>まずは、<a href="{{route("front.static.select_entry")}}" class="link">会員登録ページ</a>から仮会員登録を完了させてください。</p><p>登録したメールアドレス宛に本登録手続きのメールが届きますのでメール本文中のURLをタップして本登録を完了すればご利用が可能になります。</p><p><a href="{{route("front.member.login")}}" class="link">ログインページ</a>からログインし、</p><p>《プロフィール編集》よりあなたの履歴書を完成させてください。</p><p>《企業検索》からご希望の条件を絞って企業を検索し、企業ページ中の</p><p>《面接依頼または質問をする》ボタンをタップして採用担当者と直接メッセージのやり取りを行うことができます。<p></p>Web面接を行う場合は、企業より送られるWeb面接予約をタップしてWeb面接ルームに入室をし、《接続する》ボタンをタップし面接を開始してください。</p><p>※Web面接ルーム入室前に、利用可能なブラウザのチェックボックスにチェックを入れてください面接結果はメッセージ画面に届きます。その後は企業の指示に従ってください。</p></div></dd>
                <dt class="main__qa">企業からオファーはきますか？</dt>
                <dd class="main__ans"><p>あなたのWeb履歴書を見て、あなたに魅力を感じた企業の採用担当者からメッセージが届きます。</p></dd>
                <dt class="main__qa">Web面接の仕方がわからないのですが</dt>
                <dd class="main__ans"><div><p>メニュー中の《Web面接》から、<a href="{{route("front.video-interview.list")}}" class="link">面接予約一覧</a>より予約内容を確認してください。</p><p>面接日時になりましたら、利用可能なブラウザのチェックボックスにチェックを入れ、</p><p>《Web面接ルームへ》をタップして入室し、面接時間になったら</p><p>《接続する》をタップして面接を開始してください。</p></div></dd>
            </dl>
            <h2 class="headline main__qa--more" id="qa__list--open">質問をもっと見る</h2>
            <dl class="qa__list">
                <dt class="main__qa--more-qa">面接結果はどのようにして通知されますか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>メッセージにて合否連絡が届きます。</p><p>その後の動きについては、企業の指示に従ってください。</p></div></div></dd>
                <dt class="main__qa--more-qa">面接をキャンセルしたいのですが。</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><p>ログイン後、メニュー中の《Web面接》から、<a href="{{route("front.video-interview.list")}}" class="link">面接予約一覧</a>をタップし、キャンセルを行ってください。</p></div></dd>
                <dt class="main__qa--more-qa">Web面接は必須ですか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>Web面接は必須ではありません。</p><p>企業によってはWeb面接を必要としない場合もございます。</p></div></div></dd>
                <dt class="main__qa--more-qa">Web履歴書の作り方がわからないのですが。</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><p><a href="{{route("front.static.describe")}}" class="link">LinkTの使い方</a>をご覧ください</p></div></dd>
                <dt class="main__qa--more-qa">利用料金は無料ですか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><p>完全無料です。</p></div></dd>
                <dt class="main__qa--more-qa">インターン選考も受け付けてますか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>受け付けております。</p><p>インターンタグがついている企業はインターン選考を実施していますので、</p><p>積極的にコンタクトをとってください。</p></div></div></dd>
                <dt class="main__qa--more-qa">利用・登録できる学生の対象はありますか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><p>大学、大学院、短大、高専、専門学校の学生の方、大学卒業後2年以内の方が対象となっております。</p></div></dd>
                <dt class="main__qa--more-qa">自分の履歴書が他の学生に見られることはありますか？</dt>
                <dd class="main__qa--more-ans"><div class="ans__box"><div><p>あなたの履歴書が他の学生に見られることはありませんのでご安心ください。</p><p>あなたの履歴書を見ることができるのは、個人情報保護方針に基づきLinkTと契約を交わし登録を完了させた企業の採用担当のみとなっております。</p></div></div></dd>
            </dl>
        </section>
        @endif
        <div class="navBk">
            @if(!isset($memberAuthentication))
                <a href="{{route("front.static.select_entry")}}">会員登録</a>
            @endif
            <a href="{{route('front.static.describe')}}">使い方はこちら</a></div>
    </section>
@stop