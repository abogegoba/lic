{{$data->get("member.lastName")}} {{$data->get("member.firstName")}} 様<br>
<br>
この度は「LinkT」に事前登録いただきまして誠にありがとうございました。<br>
ご利用いただくアカウントの準備ができましたので以下のとおりご案内いたします。<br>
<br>
URLをクリックし、事前登録を完了させてご利用ください。<br>
<br>
<br>
＜事前登録完了のお手続き＞<br>
<br>
完了URL： <a href="{{$data->get("completionURL")}}">{{$data->get("completionURL")}}</a><br>
<br>
パスワード：{{$data->get("password")}}<br>
<br>
※ パスワードは仮パスワードです。<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ログイン後、プロフィール変更機能にて変更してください。<br>
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