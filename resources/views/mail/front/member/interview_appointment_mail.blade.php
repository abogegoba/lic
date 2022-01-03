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
