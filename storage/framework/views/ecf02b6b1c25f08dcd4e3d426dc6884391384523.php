<?php $__env->startSection('title', 'Home'); ?>


<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post">
            <h4>
                <a href="<?php echo e(url(route('postPage', ['post_slug' => $post->slug]))); ?>" class="post-link text-decoration-none"><?php echo e($post->title); ?></a>
            </h4>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages/layouts/index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebServers\xampp-7-4-7\htdocs\post-comments\resources\views/pages/homePage/index.blade.php ENDPATH**/ ?>