@extends('layouts.gerant')
@section('content')

	<!-- Sidebar -->
    @include('layouts.ge_sidebar')
	<!-- /Sidebar -->

    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Historique de transactions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Caissier</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom complet</th>
                                    <th>Montant</th>
                                    <th>Devise</th>
                                    <th>Methode</th>
                                    <th>Référence</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $key=>$transaction )
                                <tr>
                                    <td>1</td>
                                    <td>{{ $transaction->fullname }}</td>
                                    <td>{{ $transaction->amount." ".$transaction->currency }}</td>
                                    <td>{{ $transaction->method }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td><span class="badge bg-inverse-success">{{ $transaction->status }}</span></td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
@endsection
