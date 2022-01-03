@if(isset($memberAuthentication))
<nav id="mypageMenu">
    <h2>マイページ</h2>
    <ul>
        <li><a href="{{route('front.company.list')}}">企業検索</a></li>
        <li><a href="{{route('front.message.list')}}">メッセージ</a></li>
        <li><a href="{{route('front.video-interview.list')}}">Web面接</a></li>
        <li><a href="{{route('front.profile')}}">プロフィール</a></li>
    </ul>
</nav>
@endif