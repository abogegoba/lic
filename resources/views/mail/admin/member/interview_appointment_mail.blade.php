{{$data->get("memberName")}} 様<br>
<br>
いつも「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の面接の開催日時をご案内いたします。<br>
<br>
面接企業：{{$data->get("companyName")}}<br>
面接日時：{{$data->get("appointmentDatetime")}}<br>
<br>
ログインの上、ご確認ください。<br>
<br>
<a href="{{$data->get("memberVideoInterviewReservationDetailUrl")}}">{{$data->get("memberVideoInterviewReservationDetailUrl")}}</a><br>
<br>
<br>
@include('mail.admin.member.common.auto_footer')
