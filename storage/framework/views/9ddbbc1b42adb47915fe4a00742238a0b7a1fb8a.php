<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('client/css/layout_client.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/common_client.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/common_custom.css')); ?>">
<?php echo $__env->yieldContent('css'); ?>
<!-- Google Tag Manager -->
    
    <!-- End Google Tag Manager -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo e(asset('client/js/fitie.js')); ?>"></script>
    <script src="<?php echo e(asset('client/js/common.js')); ?>"></script>
    <script src="<?php echo e(asset('client/js/common_custom.js')); ?>"></script>

    <script>window.Promise || document.write('<script src="<?php echo e(asset('client/js/promise-7.0.4.min.js')); ?>"><\/script>');</script>
</head>

<body>
<div id="container" class="client">
    <main id="main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>



<script src="<?php echo e(asset('client/js/slick/slick.min.js')); ?>"></script>

<?php echo $__env->yieldContent('js'); ?>

</body>
<!-- Google Tag Manager (noscript) -->

<!-- End Google Tag Manager (noscript) -->
</html>
