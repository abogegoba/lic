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
　<a href="<?php echo e(route('front.contact')); ?>"><?php echo e(route('front.contact')); ?></a><br>
<br>
<?php echo $__env->make('mail.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>