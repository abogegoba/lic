{{$data->get("companyName")}} <br>
{{$data->get("pic_name")}} 様<br>
<br>
いつも「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の面接を予約しました。<br>
<br>
面接者：{{$data->get("companyAccountUserName")}} 様<br>
面接日時：{{$data->get("appointmentDatetime")}}<br>
<br>
ログインの上、ご確認ください。<br>
<br>
<a href="{{$data->get("companyVideoInterviewReservationDetailUrl")}}">{{$data->get("companyVideoInterviewReservationDetailUrl")}}</a><br>
<br>
<br>
@include('mail.front.client.common.auto_footer')
