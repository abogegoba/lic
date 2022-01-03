<?php if(!empty($errors->get("business_exception"))): ?>
    <div id="errors" class="alert alert-light" role="alert">
        <?php $__currentLoopData = $errors->get("business_exception"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(empty($target) || (!empty($target) && preg_match("@^business.".$target."$@",$key))): ?>
                <?php echo e($message); ?><br>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>