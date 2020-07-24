<?php $__env->startSection('title', 'Post'); ?>


<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post">
            <h4>
                <?php echo e($post_item->title); ?>

            </h4>
            <div class="post-content"><?php echo e($post_item->description); ?></div>
        </div>
        <div id="post-comments-section" class="mt-5">
            <post-comments :post-id="<?php echo e($post_item->id); ?>" />
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages/layouts/index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\WebServers\xampp-7-4-7\htdocs\post-comments\resources\views/pages/postPage/index.blade.php ENDPATH**/ ?>