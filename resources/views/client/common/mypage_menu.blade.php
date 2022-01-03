<nav id="mypageMenuNew">
    <ul>
        <li>
            <a href="{{route('client.student.list')}}">
                <img src="{{asset('/img/client/common/icon-search.png')}}" alt="">
            </a>
            <p>学生検索</p>
        </li>
        <li>
            <a href="{{route('client.message.list')}}">
                <img src="{{asset('/img/client/common/icon-message.png')}}" alt="">
            </a>
            <p>メッセージ</p>
        </li>
        <li>
            <a href="{{route('client.video-interview.list')}}">
                <img src="{{asset('/img/client/common/icon-video.png')}}" alt="">
            </a>
            <p>Web面接</p>
        </li>
        <li>
            <a href="{{route('client.company-edit.basic-information')}}">
                <img src="{{asset('/img/client/common/icon-company.png')}}" alt="">
            </a>
            <p>企業編集</p>
        </li>
        <li>
            <a href="{{route('client.like.member.list')}}">
                <img src="{{asset('/img/client/common/heart-regular.png')}}" alt="">
            </a>
            <p>気になる</p>
        </li>
    </ul>
</nav>
<div id="drawer">
    <span class="up_down"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
</div>
