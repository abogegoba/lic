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
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+<br>
■ご注意事項<br>
<br>
※ 本メールは送信専用アドレスより自動送信しております。<br>
　送信専用のため、このメールにご質問などをご返信いただいても<br>
　お答えすることができません。<br>
<br>
※ 本メールにお心当たりがない方は、誤送信の可能性がございます。<br>
　その場合は、お手数ですが本メールの破棄をお願い致します。<br>
※ ご不明点などがございましたら、下記のURLよりお問合せください。<br>
　<a href="{{$data->get("contactURL")}}">{{$data->get("contactURL")}}</a><br>
<br>
@include('mail.common.footer')