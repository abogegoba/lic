この度は「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の内容でお問合せを受付けいたしました。<br>
担当より順次ご連絡差し上げますので、今しばらくお待ちください。<br>
<br>
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+<br>
■お問合せ内容<br>
<br>
＜お問い合わせの種類＞<br>
　{{$data->get("contactKindName")}}<br>
<br>
＜氏名＞<br>
　{{$data->get("contact.lastName")}} {{$data->get("contact.firstName")}}<br>
<br>
＜氏名かな＞<br>
　{{$data->get("contact.lastNameKana")}} {{$data->get("contact.firstNameKana")}}<br>
<br>
＜学校名＞<br>
　{{$data->get("contact.schoolName")}}<br>
<br>
＜学部・学科名＞<br>
　{{$data->get("contact.faculty")}}<br>
<br>
＜電話番号＞<br>
　{{$data->get("contact.tel")}}<br>
<br>
＜メールアドレス＞<br>
　{{$data->get("contact.mail")}}<br>
<br>

＜お問い合わせ内容＞<br>
　{{$data->get("contact.contact")}}<br>
<br>
@include('mail.front.member.common.auto_footer')