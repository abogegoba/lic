<?php echo e($data->get("member.lastName")); ?> <?php echo e($data->get("member.firstName")); ?> 様<br>
<br>
この度は「LinkT」にご登録いただきまして<br>
誠にありがとうございます。<br>
<br>
ご登録を完了いたしました。<br>
下記のURLからログインしていただき、本サービスをご利用ください。<br>
<br>
＜ログインのご案内＞<br>
<a href="<?php echo e(route(("front.top"))); ?>"><?php echo e(route('front.top')); ?></a><br>
<br>
<?php echo $__env->make('mail.front.member.common.auto_footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
