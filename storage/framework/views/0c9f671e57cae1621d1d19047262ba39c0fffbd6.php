<?php if(!empty($errors) && !empty($errors->get("business_exception"))): ?>
    <div class="invalid-form">
        <?php $__currentLoopData = $errors->get("business_exception"); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(empty($target) || (!empty($target) && preg_match("@^business.".$target."$@",$key))): ?>
                <div class="form-control-label invalid-feedback invalid-control">
                    <i class="fas fa-exclamation-triangle icon icon-lg"></i>
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>