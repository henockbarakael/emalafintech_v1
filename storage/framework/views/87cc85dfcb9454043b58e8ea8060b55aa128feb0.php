<?php $__env->startSection('content'); ?>

	<!-- Sidebar -->
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- /Sidebar -->

    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img alt="" src="<?php echo e(URL::to('/assets/images/'. Auth::user()->avatar)); ?>">
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, <?php if(auth()->guard()->check()): ?>
                                <?php echo e(Auth::user()->firstname." ".Auth::user()->name); ?>

                            <?php endif; ?></h3>
                            <p><?php echo e($todayDate); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Content Starts -->
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Solid justified</h4> -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                        <li class="nav-item"><a class="nav-link active"  href="<?php echo e(route('home')); ?>">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.transactions.all')); ?>">All </a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.emala.all')); ?>">Emala</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.moneygram.all')); ?>">Moneygram</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.mobilemoney.all')); ?>">Mobile</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.paytv.all')); ?>">Pay TV</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.retrait.all')); ?>">Retrait </a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.emprunt.all')); ?>">Emprunt </a></li>
                    </ul>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3><b><?php echo e($user); ?></b></h3>
                            <p>Nbre. d'utilisateurs</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="text-success"><b>
                                
                                <?php echo e($comcdf); ?>

                                

                                </b></h3>
                            <p>Total Commission FC</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3><b><?php echo e($comusd); ?></b></h3>
                            <p>Total Commission USD</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3><b><?php echo e($transaction); ?></b></h3>
                            <p>Nbre. de transactiosn</p>
                        </div>
                    </div>
                </div>
            </div>

            

            <?php $__currentLoopData = $req; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
               $d_amount =0;
                $c_amount =0;
                $mm_amount =0;
                $m_amount =0;
                $e_amount =0;
                $mmr_amount =0;
                $mr_amount =0;
                $er_amount =0;
                $number = 0;
                $operator ='';
                $data_transfert = '';
                $data_retrait = '';
        foreach ($req as $key=>$value) {
        if($value->operator=="Emala" && $value->transaction_type=="Transfert"){
                $e_amount = $value->amount;
                $number = $value->number;
             }
             elseif($value->operator=="Moneygram" && $value->transaction_type=="Transfert"){
                $m_amount = $value->amount;
                $number = $value->number;
             }
             elseif($value->operator=="Mobile money" && $value->transaction_type=="Transfert"){
                $mm_amount = $value->amount;
                $number = $value->number;
             }

        elseif($value->operator=="Emala" && $value->transaction_type=="Retrait"){
                $er_amount = $value->amount;
                $number = $value->number;
             }
             elseif($value->operator=="Moneygram" && $value->transaction_type=="Retrait"){
                $mr_amount = $value->amount;
                $number = $value->number;
             }
             elseif($value->operator=="Mobile money" && $value->transaction_type=="Retrait"){
                $mmr_amount = $value->amount;
                $number = $value->number;
             }
             $data_retrait .= '{ y: '.++$key.', a: '.$er_amount.', b: '.$mr_amount.', c: '.$mmr_amount.'},';
             $data_transfert .= '{ y: '.++$key.', a: '.$e_amount.', b: '.$m_amount.', c: '.$mm_amount.'},';

        }

                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12 text-center">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Statistique d'envois</h3>
											<div id="bar-charts"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>

                <div class="col-md-6">
                    <div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12 text-center">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Statistique de retraits</h3>
											<div id="bar-chartis"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <!-- /Content End -->

        </div>
        <!-- /Page Content -->

    </div>
    <script src="<?php echo e(URL::to('assets/js/jquery-3.5.1.min.js')); ?>"></script>
	<!-- Bootstrap Core JS -->
	<script src="<?php echo e(URL::to('assets/js/popper.min.js')); ?>"></script>
	<script src="<?php echo e(URL::to('assets/js/bootstrap.min.js')); ?>"></script>
	<!-- Slimscroll JS -->
	<script src="<?php echo e(URL::to('assets/js/jquery.slimscroll.min.js')); ?>"></script>
    <!-- Chart JS -->
	<script src="<?php echo e(URL::to('assets/plugins/morris/morris.min.js')); ?>"></script>
	<script src="<?php echo e(URL::to('assets/plugins/raphael/raphael.min.js')); ?>"></script>
	
	<!-- Select2 JS -->
	<script src="<?php echo e(URL::to('assets/js/select2.min.js')); ?>"></script>
	<!-- Datetimepicker JS -->
	<script src="<?php echo e(URL::to('assets/js/moment.min.js')); ?>"></script>
	<script src="<?php echo e(URL::to('assets/js/bootstrap-datetimepicker.min.js')); ?>"></script>
	<!-- Datatable JS -->
	<script src="<?php echo e(URL::to('assets/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(URL::to('assets/js/dataTables.bootstrap4.min.js')); ?>"></script>
	<!-- Multiselect JS -->
	<script src="<?php echo e(URL::to('assets/js/multiselect.min.js')); ?>"></script>
	<!-- Custom JS -->
	<script src="<?php echo e(URL::to('assets/js/app.js')); ?>"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                // Bar Chart

                // Morris.Bar({
                //     element: 'bar-charts',
                //     data: [<?php echo e($data_transfert); ?>],
                //     xkey: 'y',
                //     ykeys: ['a', 'b'],
                //     labels: ['Debit', 'Credit'],
                //     lineColors: ['#f43b48','#453a94'],
                //     lineWidth: '3px',
                //     barColors: ['#00A75E', '#FD8325']
                //     resize: true,
                //     redraw: true
                // });

	Morris.Bar({
		element: 'bar-charts',
		data: [
			<?php echo e($data_transfert); ?>

		],
		xkey: 'y',
		ykeys: ['a', 'b','c'],
		labels: ['Emala', 'Moneygram','Mobile money'],
		lineColors: ['green',' #3498db','red'],
		lineWidth: '3px',
		barColors: ['green',' #3498db','red'],
		resize: true,
		redraw: true
	});

    Morris.Bar({
		element: 'bar-chartis',
		data: [
			<?php echo e($data_retrait); ?>

		],
		xkey: 'y',
		ykeys: ['a', 'b','c'],
		labels: ['Emala', 'Moneygram','Mobile money'],
		lineColors: ['green',' #3498db','red'],
		lineWidth: '3px',
		barColors: ['green',' #3498db','red'],
		resize: true,
		redraw: true
	});

                // Line Chart

                Morris.Line({
                    element: 'line-charts',
                    data: [
                        { y: '2006', a: 50, b: 90 },
                        { y: '2007', a: 75,  b: 65 },
                        { y: '2008', a: 50,  b: 40 },
                        { y: '2009', a: 75,  b: 65 },
                        { y: '2010', a: 50,  b: 40 },
                        { y: '2011', a: 75,  b: 65 },
                        { y: '2012', a: 100, b: 50 }
                    ],
                    xkey: 'y',
                    ykeys: ['a', 'b'],
                    labels: ['Total Sales', 'Total Revenue'],
                    lineColors: ['#f43b48','#453a94'],
                    lineWidth: '3px',
                    resize: true,
                    redraw: true
                });

            });
        </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_dashlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr_ms_laravel8-main/resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>