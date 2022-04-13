
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Transactions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Historique</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Historique de transactions</h4>
                        <p class="card-text">
                            Le tableau ci-dessous affiche l'historique de toutes les transactions <code>Emala</code>. Il est possible d'exporter le fchier au format désiré.
                        </p>
                    </div>
                    <div class="card-body">

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-stripped mb-0">
                                    <thead>
                                        <tr class="table-primary">
                                            <th style="width: 10px;">#</th>
                                            <th>Expéditeur</th>
                                            <th>Montant</th>
                                            {{-- <th>Devise </th> --}}
                                            <th>Destinateur</th>
                                            <th>Référence</th>
                                            <th>Type Tans.</th>
                                            <th>Date Trans.</th>
                                            <th class="text-center">Status</th>
                                            {{-- <th class="text-right">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emala as $key=>$emala )
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{$emala->sender_fullname}}</td>
                                            <td  class="montant">{{ $emala->amount." ".$emala->currency }}</td>
                                            {{-- <td  class="e_money">{{ $emala->currency }}</td> --}}
                                            <td  class="e_desitinateur">{{ $emala->receiver_fullname }}</td>
                                            <td class="e_current">{{ $emala->transaction_id }}</td>
                                            <td class="e_current">{{ $emala->transaction_type }}</td>
                                            <td class="e_current">{{ $emala->created_at }}</td>
                                            <td class="text-center">
												<div class="dropdown action-label">
                                                    @if ($emala->status == "Pending")
                                                    <a class="btn btn-warning btn-sm " href="#"  aria-expanded="false">
														<i class="fa fa-dot-circle-o text-white"></i> {{ $emala->status }}
													</a>
                                                    @elseif ($emala->status == "Failed")
                                                    <a class="btn btn-danger btn-sm " href="#"  aria-expanded="false">
														<i class="fa fa-dot-circle-o text-white"></i> {{ $emala->status }}
													</a>
                                                    @else
                                                    <a class="btn btn-success btn-sm " href="#"  aria-expanded="false">
														<i class="fa fa-dot-circle-o text-white"></i> {{ $emala->status }}
													</a>
                                                    @endif
												</div>
											</td>
                                            {{-- <td class="text-center">
                                                <a class="btn btn-info btn-sm edit_training" href="#" data-toggle="modal" data-target="#edit_training"><i class="fa fa-eye"></i></a>
                                            </td> --}}
                                            @endforeach
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>

    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>
    <script>
        // select auto id and email
        $('#trainer').on('change',function()
        {
            $('#trainer_id').val($(this).find(':selected').data('trainer_id'));
        });
        $('#employees').on('change',function()
        {
            $('#employees_id').val($(this).find(':selected').data('employees_id'));
        });
    </script>
    <script>
        // select auto id and email
        $('#e_trainer').on('change',function()
        {
            $('#e_trainer_id').val($(this).find(':selected').data('e_trainer_id'));
        });
        $('#e_employees').on('change',function()
        {
            $('#e_employees_id').val($(this).find(':selected').data('e_employees_id'));
        });
    </script>

    {{-- update js --}}
    <script>
        $(document).on('click','.edit_training',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.e_id').text());
            $('#e_trainer_id').val(_this.find('.trainer_id').text());
            $('#e_employees_id').val(_this.find('.employees_id').text());
            $('#e_training_cost').val(_this.find('.training_cost').text());
            $('#e_start_date').val(_this.find('.start_date').text());
            $('#e_end_date').val(_this.find('.end_date').text());
            $('#e_description').val(_this.find('.description').text());

            // training_type
            var training_type = (_this.find(".training_type").text());
            var _option = '<option selected value="' +training_type+ '">' + _this.find('.training_type').text() + '</option>'
            $( _option).appendTo("#e_training_type");

            // trainer
            var trainer = (_this.find(".trainer").text());
            var _option = '<option selected value="' +trainer+ '">' + _this.find('.trainer').text() + '</option>'
            $( _option).appendTo("#e_trainer");

            // employees
            var employees = (_this.find(".employees").text());
            var _option = '<option selected value="' +employees+ '">' + _this.find('.employees').text() + '</option>'
            $( _option).appendTo("#e_employees");

            // status
            var status = (_this.find(".status").text());
            var _option = '<option selected value="' +status+ '">' + _this.find('.status').text() + '</option>'
            $( _option).appendTo("#e_status");
        });
    </script>

    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_training',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
