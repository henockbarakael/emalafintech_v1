@extends('layouts.master')
@section('content')

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Gestion des soldes</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">solde</a></li>
                            <li class="breadcrumb-item active">Liste</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Ajouter une solde</a>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('search/user/list') }}" method="POST">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="name" name="name">
                            <label class="focus-label">Chef d'solde</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="name" name="role_name">
                            <label class="focus-label">Code solde</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="name" name="status">
                            <label class="focus-label">Nom</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="sumit" class="btn btn-success btn-block"> Recherche </button>
                    </div>
                </div>
            </form>
            <!-- /Search Filter -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr class="table-primary">
                                    <th>Agence</th>
                                    <th>Code</th>
                                    <th>Solde USD</th>
                                    <th>Solde CDF</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solde as $key=>$solde )
                                <tr>
                                        @php
                                            if($solde->pkg_cdf||$solde->pkg_usd == ""){
                                                $solde->pkg_usd = 0;
                                                $solde->pkg_cdf  = 0;
                                            }
                                        @endphp
                                            <td class="telephone">{{$solde->nom}}</td>
                                            <td class="telephone">{{$solde->code}}</td>
                                            <td class="usd">{{$solde->pkg_usd}}</td>
                                            <td hidden class="ids">{{ $solde->id }}</td>
                                            <td class="fc">{{$solde->pkg_cdf}}</td>
                                            <td class="c_date">{{$solde->created_at}}</td>
                                            <td class="u_date">{{$solde->updated_at}}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item edit_user" data-toggle="modal"  data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item userDelete" href="#" data-toggle="modal"  data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>Téléphone</th>
                                            <th>USD</th>
                                            <th>CDF </th>
                                            <th>Crée le</th>
                                            <th>Mise à jour le</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($solde as $key => $solde)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td class="telephone">{{$solde->telephone}}</td>
                                            <td class="usd">{{$solde->usd}}</td>
                                            <td hidden class="ids">{{ $solde->id }}</td>
                                            <td class="fc">{{$solde->fc}}</td>
                                            <td class="c_date">{{$solde->created_at}}</td>
                                            <td class="u_date">{{$solde->updated_at}}</td>
                                            <td>
                                                <a class="btn btn-purple userUpdate" data-toggle="modal"  data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
     <!-- Edit User Modal -->
     <div id="edit_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recharger un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>
                <div class="modal-body">
                    <form action="{{ route('debit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="rec_id" id="e_id" solde="">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input class="form-control" type="text" id="e_telephone" name="telephone" placeholder="243xxxxxxxx">
                                </div>
                            </div>

                        </div>


                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Devise</label>
                                <select class="select" name="currency" id="e_de">

                                    <option solde="USD">{{ __('USD') }}</option>
                                    <option solde="CDF">{{ __('CDF') }}</option>

                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Montant</label>
                                    <input class="form-control" type="text" id="e_montant" name="montant" placeholder="100 USD">
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Opérateur</label>
                                <select class="select" name="method" id="e_department">

                                    <option solde="mpesa">{{ __('Vodacom') }}</option>
                                    <option solde="airtel">{{ __('Airtel') }}</option>
                                    <option solde="orange">{{ __('Orange') }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Recharger</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Salary Modal -->

    <!-- /Page Wrapper -->
    @section('script')
    <script>
        $(document).on('click','.userUpdate',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.ids').text());
            $('#e_telephone').val(_this.find('.telephone').text());

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
            var _option = '<option selected solde="' +training_type+ '">' + _this.find('.training_type').text() + '</option>'
            $( _option).appendTo("#e_training_type");

            // trainer
            var trainer = (_this.find(".trainer").text());
            var _option = '<option selected solde="' +trainer+ '">' + _this.find('.trainer').text() + '</option>'
            $( _option).appendTo("#e_trainer");

            // employees
            var employees = (_this.find(".employees").text());
            var _option = '<option selected solde="' +employees+ '">' + _this.find('.employees').text() + '</option>'
            $( _option).appendTo("#e_employees");

            // status
            var status = (_this.find(".status").text());
            var _option = '<option selected solde="' +status+ '">' + _this.find('.status').text() + '</option>'
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
