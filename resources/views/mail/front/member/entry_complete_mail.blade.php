{{$data->get("member.lastName")}} {{$data->get("member.firstName")}} 様<br>
<br>
この度は「LinkT」にご登録いただきまして<br>
誠にありがとうございます。<br>
<br>
ご登録を完了いたしました。<br>
下記のURLからログインしていただき、本サービスをご利用ください。<br>
<br>
＜ログインのご案内＞<br>
<a href="{{route(("front.top"))}}">{{route('front.top')}}</a><br>
<br>
@include('mail.front.member.common.auto_footer')
