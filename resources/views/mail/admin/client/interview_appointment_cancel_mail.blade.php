{{--企業名--}}
{{$data->get('companyAccount.company.name')}}<br>
{{--担当者名--}}
{{$data->get('companyAccount.lastName')}} {{$data->get('companyAccount.firstName')}}様<br>
<br>
いつも「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の面接がキャンセルとなりましたのでご案内いたします。<br>
<br>
{{--会員名--}}
面接者：{{$data->get('member.lastName')}} {{$data->get('member.firstName')}}<br>
{{--面接日時--}}
面接日時：{{$data->get('appointmentDatetime')}}<br>
<br>
キャンセルメッセージ：<br>
{{$data->get('cancelMessage')}}<br>
<br>
@include('mail.admin.client.common.auto_footer')