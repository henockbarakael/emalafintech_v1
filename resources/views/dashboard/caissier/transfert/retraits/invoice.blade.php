
@extends('layouts.exportmaster')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Sidebar -->
    {{-- @include('layouts.ca_sidebar') --}}
    <!-- /Sidebar -->
{{-- <style>.no-print{
    display: none;
}</style> --}}
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid" id="app">
            <!-- Page Header -->
            <div class="page-header no-print">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Bordereau</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Bordereau</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white">CSV</button>
                            <button class="btn btn-white"><a href=""@click.prevent="printme" target="_blank">PDF</a></button>
                            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> <a href="" @click.prevent="printme" target="_blank"> Print</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row" style="margin-left: -240px;">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="payslip-title">Bordereau de retrait du {{ \Carbon\Carbon::now()->format('M') }}   {{ \Carbon\Carbon::now()->year }}  </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    {{-- @if(!empty($users->avatar)) --}}
                                    <img src="{{ URL::to('assets/img/logo.png') }}" class="inv-logo" alt="">
                                    {{-- @endif --}}
                                     <ul class="list-unstyled mb-0">
                                        <li>Lumumba & Partners</li>
                                        <li>Immeuble Groupe Taverne 54,</li>
                                        <li>Boulevard du 30 juin,</li>
                                        <li>Kinshasa, RDCongo</li>
                                        <li>Phone number : (+243) 821 817 621</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Bordereau #INV-0001</h3>
                                        <ul class="list-unstyled">
                                            <li>Date: <span>{{$dt}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
                                    <h5>Bordereau de:</h5>
                                     <ul class="list-unstyled">
                                        <li><h5><strong>{{$transactions->receiver_fullname}}</strong></h5></li>
                                        <li><span>{{$transactions->receiver_phone}}</span></li>
                                        <li>{{$transactions->receiver_city}}</li>
                                        <li>{{$transactions->receiver_country}}</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-lg-5 col-xl-4 m-b-20">
                                    <span class="text-muted">Details de paiement:</span>
                                    <ul class="list-unstyled invoice-payment-details">
                                        <li><h5>Total à payer: <span class="text-right">{{$transactions->amount." ".$transactions->currency}}</span></h5></li>
                                        <li>Banque: <span>Emala Fintech</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>EXPEDITEUR</th>
                                            <th class="d-none d-sm-table-cell">MONTANT</th>
                                            <th>DEVISE</th>
                                            <th>MOTIF</th>
                                            <th>DESTINATEUR</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$transactions->sender_fullname}}</td>
                                            <td class="d-none d-sm-table-cell">{{$transactions->amount}}</td>
                                            <td>{{$transactions->currency}}</td>
                                            <td>{{$transactions->details}}</td>
                                            <td>{{$transactions->receiver_fullname}}</td>
                                            <td class="text-right">{{$transactions->amount}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <div class="row bordereau-payment">
                                    <div class="col-sm-8">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="m-b-20">
                                            <div class="table-responsive no-border">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th>Subtotal:</th>
                                                            <td class="text-right">$7,000</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tax: <span class="text-regular">(25%)</span></th>
                                                            <td class="text-right">$1,750</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td class="text-right text-primary"><h5>$8,750</h5></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bordereau-info">
                                    <h5>Other information</h5>
                                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero, eu finibus sapien interdum vel</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection
