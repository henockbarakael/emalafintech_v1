<?php $__env->startSection('content'); ?>
    <div class="main-wrapper">	
        <div class="error-box">
            <h1>419</h1>
            <h3><i class="fa fa-warning"></i> Oops! PAGE EXPIRED!</h3>
            <p>The page you requested was not found.</p>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-custom">Back to Home</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr_ms_laravel8-main/resources/views/errors/419.blade.php ENDPATH**/ ?>