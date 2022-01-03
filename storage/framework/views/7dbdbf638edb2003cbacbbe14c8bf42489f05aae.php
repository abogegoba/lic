<?php echo e($data->get("member.lastName")); ?> <?php echo e($data->get("member.firstName")); ?> 様<br>
<br>
この度は「LinkT」にご登録いただきまして<br>
誠にありがとうございます。<br>

以下の内容で受け付けいたしました。<br>
下記のURLをクリックし、会員登録を完了してください。<br>
<br>
<a href="<?php echo e($data->get("completionURL")); ?>"><?php echo e($data->get("completionURL")); ?></a><br>
<?php echo $__env->make('mail.front.member.common.auto_footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>