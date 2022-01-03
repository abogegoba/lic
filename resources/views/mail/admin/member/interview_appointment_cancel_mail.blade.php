{{--会員名--}}
{{$data->get('member.lastName')}} {{$data->get('member.firstName')}} 様<br>
<br>
いつも「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の面接がキャンセルとなりましたのでご案内いたします。<br>
<br>
{{--企業名--}}
面接企業：{{$data->get('companyAccount.company.name')}}<br>
{{--面接日時--}}
面接日時：{{$data->get('appointmentDatetime')}}<br>
<br>
キャンセルメッセージ：<br>
{{$data->get('cancelMessage')}}<br>
<br>
@include('mail.admin.member.common.auto_footer')