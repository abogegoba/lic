<div v-if="<?php echo e($target); ?>" v-for="errorMessage in <?php echo e($target); ?>" class="invalid-message">
    <p class="invalid-message">
        {{ errorMessage }}
    </p>
</div>