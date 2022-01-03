<?php echo e($data->get("companyName")); ?> <br>
<?php echo e($data->get("pic_name")); ?> 様<br>
<br>
いつも「LinkT」をご利用いただきまして<br>
誠にありがとうございます。<br>
<br>
以下の面接を予約しました。<br>
<br>
面接者：<?php echo e($data->get("companyAccountUserName")); ?> 様<br>
面接日時：<?php echo e($data->get("appointmentDatetime")); ?><br>
<br>
ログインの上、ご確認ください。<br>
<br>
<a href="<?php echo e($data->get("companyVideoInterviewReservationDetailUrl")); ?>"><?php echo e($data->get("companyVideoInterviewReservationDetailUrl")); ?></a><br>
<br>
<br>
<?php echo $__env->make('mail.front.client.common.auto_footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
