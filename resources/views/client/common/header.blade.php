<header id="hdr" class="requid">
    <h1 id="hdr__logo"><a href="{{route('client.top')}}"><img src="{{asset('img/common/logo.png')}}" alt="次世代型新卒採用サービス：LinkT"></a></h1>
    @if(empty($clientAuthentication))
        <a id="hdr__anc" href="/"><span>学生の方はこちら</span></a>
    @endif
    <nav id="hdr__nav">
        @if(empty($clientAuthentication))
        <p>会員企業はこちら</p>
        <ul id="login_menu">
            <li><a href="{{route('client.login')}}">ログイン</a></li>
        </ul>
        @else
        <ul id="notification">
            <li onclick="myFunction('msg_dropdown')">
                <a>
                    {{--<i class="fa fa-commenting-o" aria-hidden="true"></i>--}}
                    <img src="{{asset('img/common/comment-dots-regular.png')}}" alt="">
                    <span id="msg_ntfy" data-msg_count="0">0</span>
                </a>
                <!-- dropdown menu-->
                <div class="notification_dropdown" id="msg_dropdown">
                    {{--<i class="fa fa-caret-up" aria-hidden="true"></i>--}}
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
        @endif
    </nav>
    <button id="hdr__button"><span></span><strong>MENU</strong></button>
</header>
