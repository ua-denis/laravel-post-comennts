<html>
<head>
    <title>Page - <?php echo $__env->yieldContent('title'); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
</head>
<body>

<div class="container mt-5">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="<?php echo e(mix('js/app.js')); ?>"></script>
</body>
</html>
<?php /**PATH D:\WebServers\xampp-7-4-7\htdocs\post-comments\resources\views/pages/layouts/index.blade.php ENDPATH**/ ?>