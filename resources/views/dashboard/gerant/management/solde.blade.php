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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Solde compte</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">Gérant</li>
                            <li class="breadcrumb-item"><a href="{{route('gerant.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Compte</li>
                        </ul>
                    </div>
                    {{-- <div class="col-auto float-right ml-auto">
                        <a href="{{route('management.caissier.form')}}" class="btn add-btn" ><i class="fa fa-plus"></i> Recharger un compte</a>
                        <div class="view-icons">
                            <a href="employees.html" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                            <a href="employees-list.html" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            {{-- <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee ID</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>Select Designation</option>
                            <option>Web Developer</option>
                            <option>Web Designer</option>
                            <option>Android Developer</option>
                            <option>Ios Developer</option>
                        </select>
                        <label class="focus-label">Designation</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div> --}}
            <!-- /Search Filter -->
            <div class="row justify-content-center">
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3><b>{{number_format($sum_credit_usd,2)}}</b></h3>
                            <p>Total USD CREDIT</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="text-success"><b>{{number_format($sum_debit_usd,2)}}</b></h3>
                            <p>Total USD DEBIT</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="text-danger"><b>{{number_format($sum_credit_cdf,2)}}</b></h3>
                            <p>Total CDF CREDIT</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3><b>{{number_format($sum_debit_cdf,2)}}</b></h3>
                            <p>Total CDF DEBIT</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Id compte</th>
                                    <th class="text-center">Solde credit</th>
                                    <th class="text-center">Solde debit</th>
                                    <th class="text-center">Total solde</th>
                                    <th class="text-center">Devise</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solde as $key=>$solde )
                                <tr>
                                    <td class="s_id">{{$solde->compte_id}}</td>
                                    {{-- <td class="a_id" style="display: none">{{$solde->id}}</td> --}}
                                    <td class="s_credit text-center">{{number_format($solde->credit,2)}}</td>
                                    <td class="s_debit text-center">{{number_format($solde->debit,2)}}</td>
                                    <td class="text-center">{{number_format($solde->debit + $solde->credit,2)}}</td>
                                    <td class="s_currency text-center">{{$solde->currency}}</td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown-action">
                                            <a class="btn btn-white btn-sm btn-rounded" href="{{ url('approvisionnement/caisse/'.$solde->compte_id) }}"><i class="fa fa-dot-circle-o text-purple" style="margin-right: 5px"></i>Récharger</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->


        <!-- Edit Employee Modal -->
        <div id="edit_compte" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" id="e_credit" value="" type="text">
                                        <input type="hidden" name="id" id="a_id" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Last Name</label>
                                        <input class="form-control" id="e_debit" value="" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                        <input class="form-control" id="e_currency" value="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Employee Modal -->

        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_user" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Employee</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('management.caissier.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" href="javascript:void(0);" class="btn add-btn btn-primary continue-btn">Supprimer</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Annuler</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Employee Modal -->

    </div>
    @section('script')
    {{-- update js --}}
    <script>
        $(document).on('click','.edit_compte',function()
        {
            var _this = $(this).parents('tr');
            $('#a_id').val(_this.find('.a_id').text());
            $('#e_id').val(_this.find('.s_id').text());
            $('#e_credit').val(_this.find('.s_credit').text());
            $('#e_debit').val(_this.find('.s_debit').text());
            $('#e_currency').val(_this.find('.s_currency').text());

        });
    </script>
    {{-- delete js --}}
    <script>
        $(document).on('click','.userDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection

@endsection
