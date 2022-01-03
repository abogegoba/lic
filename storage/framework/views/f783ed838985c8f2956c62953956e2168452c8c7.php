<?php if(!empty($errors) && !empty($target) && !empty($errors->get($target))): ?>
    <div class="invalid-form">
        <?php $__currentLoopData = $errors->get($target); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_array($message)): ?>
                <?php
                    $message = array_unique($message)
                ?>
                <?php $__currentLoopData = $message; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="invalid-feedback invalid-control">
                        <i class="fas fa-exclamation-triangle icon icon-lg"></i>
                        <?php echo e($m); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="invalid-feedback invalid-control">
                    <i class="fas fa-exclamation-triangle icon icon-lg"></i>
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>