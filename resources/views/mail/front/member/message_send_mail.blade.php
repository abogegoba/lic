{{$data->get("companyName")}}<br>
{{$data->get("companyUserName")}} 様<br>
<br>
「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の内容で {{$data->get("sendUserName")}} 様からメッセージを受信しました。<br>
<br>
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+<br>
■受信メッセージ<br>
<br>
＜送信者＞<br>
　{{$data->get("sendUserName")}}<br>
<br>
＜内容＞<br>
　{{$data->get("content")}}<br>
<br>
＜送信日時＞<br>
　{{$data->get("sendTime")}}<br>
<br>
＜ログインURL＞<br>
　<a href="{{$data->get("clientLoginURL")}}">{{$data->get("clientLoginURL")}}</a><br>
<br>
@include('mail.front.member.common.auto_footer')