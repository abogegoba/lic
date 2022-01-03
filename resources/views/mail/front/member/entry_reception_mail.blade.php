{{$data->get("member.lastName")}} {{$data->get("member.firstName")}} 様<br>
<br>
この度は「LinkT」にご登録いただきまして<br>
誠にありがとうございます。<br>

以下の内容で受け付けいたしました。<br>
下記のURLをクリックし、会員登録を完了してください。<br>
<br>
<a href="{{$data->get("completionURL")}}">{{$data->get("completionURL")}}</a><br>
@include('mail.front.member.common.auto_footer')