{{$data->get("member.lastName")}} {{$data->get("member.firstName")}} 様<br>
<br>
この度は「LinkT」にご登録いただきまして<br>
誠にありがとうございます。<br>
<br>
ご登録を完了いたしました。<br>
下記のURLからログインしていただき、本サービスをご利用ください。<br>
<br>
＜ログインのご案内＞<br>
<a href="{{env('FRONT_APP_URL')}}/login">{{env('FRONT_APP_URL')}}/login</a><br>
<br>
@include('mail.admin.member.common.auto_footer')
