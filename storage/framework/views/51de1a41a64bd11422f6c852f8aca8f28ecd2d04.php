
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="soengsouy - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="soengsouy">
        <meta name="robots" content="noindex, nofollow">
        <title>Login EMALA</title>
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(URL::to('assets/img/icon1.png')); ?>">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/bootstrap.min.css')); ?>">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/font-awesome.min.css')); ?>">
        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/line-awesome.min.css')); ?>">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/select2.min.css')); ?>">
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/bootstrap-datetimepicker.min.css')); ?>">

		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/style.css')); ?>">
        
        <link rel="stylesheet" href="<?php echo e(URL::to('assets/css/toastr.min.css')); ?>">
        <script src="<?php echo e(URL::to('assets/js/toastr_jquery.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('assets/js/toastr.min.js')); ?>"></script>
    </head>
    <body class="account-page ">
        <style>
            .invalid-feedback{
                font-size: 14px;
            }
        </style>
		<!-- Main Wrapper -->
        <?php echo $__env->yieldContent('content'); ?>
		<!-- /Main Wrapper -->
		<!-- jQuery -->
        <script src="<?php echo e(URL::to('assets/js/jquery-3.5.1.min.js')); ?>"></script>
		<!-- Bootstrap Core JS -->
        <script src="<?php echo e(URL::to('assets/js/popper.min.js')); ?>"></script>
        <script src="<?php echo e(URL::to('assets/js/bootstrap.min.js')); ?>"></script>
        <!-- Slimscroll JS -->
		<script src="<?php echo e(URL::to('assets/js/jquery.slimscroll.min.js')); ?>"></script>
		<!-- Select2 JS -->
		<script src="<?php echo e(URL::to('assets/js/select2.min.js')); ?>"></script>
		<!-- Datetimepicker JS -->
		<script src="<?php echo e(URL::to('assets/js/moment.min.js')); ?>"></script>
		<script src="<?php echo e(URL::to('assets/js/bootstrap-datetimepicker.min.js')); ?>"></script>
		<!-- Custom JS -->
		<script src="<?php echo e(URL::to('assets/js/app.js')); ?>"></script>
        <?php echo $__env->yieldContent('script'); ?>
    </body>
</html>
<?php /**PATH /var/www/html/hr_ms_laravel8-main/resources/views/layouts/app.blade.php ENDPATH**/ ?>