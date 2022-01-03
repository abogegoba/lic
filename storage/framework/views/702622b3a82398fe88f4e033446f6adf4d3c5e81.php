<?php echo e($data->get("memberName")); ?> 様<br>
<br>
「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の内容で  <?php echo e($data->get("companyName")); ?> <?php echo e($data->get("sendUserName")); ?> 様からメッセージを受信しました。<br>
<br>
+-+-+-+-+-+-+-+-+-+-+-+-+-+-+<br>
■受信メッセージ<br>
<br>
＜送信者＞<br>
　<?php echo e($data->get("companyName")); ?> <?php echo e($data->get("sendUserName")); ?><br>
<br>
＜内容＞<br>
　<?php echo e($data->get("content")); ?><br>
<br>
＜送信日時＞<br>
　<?php echo e($data->get("sendTime")); ?><br>
<br>
＜ログインURL＞<br>
　<a href="<?php echo e($data->get("frontLoginURL")); ?>"><?php echo e($data->get("frontLoginURL")); ?></a><br>
<br>
<?php echo $__env->make('mail.front.client.common.auto_footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>