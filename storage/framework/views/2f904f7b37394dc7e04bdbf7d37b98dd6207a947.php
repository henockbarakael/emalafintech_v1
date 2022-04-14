<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Dashboard - EMALA</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon.png')); ?>">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/font-awesome.min.css')); ?>">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/line-awesome.min.css')); ?>">

		<!-- Datatable CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/css/dataTables.bootstrap4.min.css')); ?>">

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/select2.min.css')); ?>">
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datetimepicker.min.css')); ?>">
        <!-- Chart CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('ssets/plugins/morris/morris.css')); ?>">

		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/line-awesome.min.css')); ?>">
        <!-- Chart CSS -->
		<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/morris/morris.css')); ?>">
        <!--Themify Icons-->
        <link rel="stylesheet" href="<?php echo e(asset('icon/themify-icons/themify-icons.css')); ?>">
        <!--Ion Icons-->
        <link rel="stylesheet" href="<?php echo e(asset('icon/ion-icon/css/ionicons.min.css')); ?>">
        
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/toastr.min.css')); ?>">
        <script src="<?php echo e(asset('assets/js/toastr_jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			
			
		<![endif]-->
    </head>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Loader -->
			<div id="loader-wrapper">
				<div id="loader">
					<div class="loader-ellips">
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					</div>
				</div>
			</div>
			<!-- /Loader -->
			<!-- Header -->
            <div class="header">

				<!-- Logo -->
                <div class="header-left" >
                    <a href="<?php echo e(route('home')); ?>" class="logo"> <img src="<?php echo e(asset('assets/img/logo.png')); ?>" width="40" height="40" alt=""> </a>
                </div>
                <!-- /Logo -->
                <a id="toggle_btn" href="javascript:void(0);" >
                    <span class="bar-icon"><span></span><span></span><span></span></span>
                </a>

				<!-- Header Title -->
                <div class="page-title-box">

                    <h3 style="font-size: 15px; margin-top: 5px">Bienvenue dans la plateforme <a href="https://emalafintech.net">EmalaFintech</a></h3>

                </div>
				<!-- /Header Title -->

				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

				<!-- Header Menu -->
				<ul class="nav user-menu">

					<!-- Search -->
					<li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<!-- /Search -->

					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
							<img src="<?php echo e(asset('assets/img/flags/fr.png')); ?>" alt="" height="20"> <span>French</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="<?php echo e(asset('assets/img/flags/fr.png')); ?>" alt="" height="16"> French
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="<?php echo e(asset('assets/img/flags/us.png')); ?>" alt="" height="16"> English
							</a>
						</div>
					</li>
					<!-- /Flag -->

					<!-- Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-02.jpg')); ?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-03.jpg')); ?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-06.jpg')); ?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
													<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-17.jpg')); ?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-13.jpg')); ?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
													<p class="noti-time"><span class="notification-time">2 days ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->

					<!-- Message Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-comment-o"></i> <span class="badge badge-pill">8</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Messages</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-09.jpg')); ?>">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">Richard Miles </span>
													<span class="message-time">12:28 AM</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-02.jpg')); ?>">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">John Doe</span>
													<span class="message-time">6 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-03.jpg')); ?>">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author"> Tarah Shropshire </span>
													<span class="message-time">5 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-05.jpg')); ?>">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author">Mike Litorus</span>
													<span class="message-time">3 Mar</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="chat.html">
											<div class="list-item">
												<div class="list-left">
													<span class="avatar">
														<img alt="" src="<?php echo e(asset('assets/img/profiles/avatar-08.jpg')); ?>">
													</span>
												</div>
												<div class="list-body">
													<span class="message-author"> Catherine Manseau </span>
													<span class="message-time">27 Feb</span>
													<div class="clearfix"></div>
													<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="chat.html">View all Messages</a>
							</div>
						</div>
					</li>
					<!-- /Message Notifications -->

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <?php if(auth()->guard()->check()): ?>
                                <span class="user-img"><img src="<?php echo e(asset('/assets/images/'. Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                                <span class="status online"></span></span>
                                <span><?php echo e(Auth::user()->name); ?></span>
                            <?php endif; ?>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?php echo e(route('profile_user')); ?>">Mon Profil</a>
                            <a class="dropdown-item" href="#">Paramètres</a>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Déconnexion</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="<?php echo e(route('profile_user')); ?>">Mon Profil</a>
						<a class="dropdown-item" href="#">Paramètres</a>
						<a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Déconnexion</a>
					</div>
				</div>
				<!-- /Mobile Menu -->

            </div>
			<!-- /Header -->
			<!-- Sidebar -->
            <?php echo $__env->make('layouts.ca_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<!-- /Sidebar -->
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /Main Wrapper -->

	<!-- jQuery -->




    </body>
</html>
<?php /**PATH /var/www/html/hr_ms_laravel8-main/resources/views/layouts/admin_dashlayout.blade.php ENDPATH**/ ?>