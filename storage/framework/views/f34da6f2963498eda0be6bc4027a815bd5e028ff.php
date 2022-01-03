<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery-ui.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/skin/skin-blue.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body>
<div class="wrapper">
    <div class="error-screen">
        <div class="error-screen-title">
            <?php echo $__env->yieldContent('screen.title'); ?>
        </div>

        <div class="error-screen-body py-5">
            <?php echo $__env->yieldContent('screen.body'); ?>
        </div>

        <div class="btn-row">
            <?php echo $__env->yieldContent('btn.row'); ?>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>

</body>
</html>