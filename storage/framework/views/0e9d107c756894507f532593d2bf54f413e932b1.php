<div v-if="<?php echo e($target); ?>" v-for="message in <?php echo e($target); ?>" class="invalid-feedback invalid-control">
    <i class="fas fa-exclamation-triangle icon icon-lg"></i>
    {{ message }}
</div>