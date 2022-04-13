@extends('layouts.caissier')
@section('content')

	<!-- Sidebar -->
    @include('layouts.ca_sidebar')
	<!-- /Sidebar -->

    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img alt="" src="{{ URL::to('/assets/images/'. Auth::user()->avatar) }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, @auth
                                {{ Auth::user()->firstname." ".Auth::user()->name}}
                            @endauth</h3>
                            <p>{{$todayDate }}</p>
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
                        <li class="nav-item"><a class="nav-link active" href="user-dashboard.html">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="">All </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.emala.all') }}">Emala</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.moneygram.all') }}">Moneygram</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.mobilemoney.all') }}">Mobile</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.paytv.all') }}">Pay TV</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.retrait.all') }}">Retrait </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.emprunt.all') }}">Emprunt </a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-file-text-o"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $user }}</h3>
                                <span>Total Users</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-clipboard"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $user }}</h3>
                                <span>Total Commission</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-retweet"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{$transaction}}</h3>
                                <span>Total Transaction</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-floppy-o"></i></span>
                            <div class="dash-widget-info">
                                <h3>220</h3>
                                <span>Saved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12 text-center">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Total Revenue</h3>
											<div id="bar-charts"></div>
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
@endsection
