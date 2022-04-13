@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
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
                        <h3 class="page-title">Commissions</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Commissions</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add_overtime"><i class="fa fa-plus"></i> Ajouter une commission</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Commissions</h4>
                        <p class="card-text">
                            Le tableau ci-dessous affiche la liste de <code>rdes commissions</code>. Il est possible d'exporter le fchier au format désiré.
                        </p>
                    </div>
                    <div class="card-body">

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-stripped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Désignation</th>
                                            <th hidden class="text-left">Téléphone</th>
                                            <th class="text-left">Type commission</th>
                                            <th class="text-center">Pourcentage</th>
                                            <th class="text-left">Created at</th>
                                            <th class="text-left">Updated at</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commissions as $key=>$commission )
                                        <tr>
                                            <td class="code">{{ ++$key}}</td>
                                            <td hidden class="id">{{ $commission->id }}</td>
                                            <td class="nom text-left">{{ $commission->nom_commission }}</td>
                                            <td class="type text-left">{{ $commission->type_commission}}</td>
                                            <td class="pourcentage text-center">{{ $commission->pourcentage." %"}}</td>
                                            <td class="text-left">{{ $commission->created_at }}</td>
                                            <td class="text-left">{{ $commission->updated_at}}</td>
                                            <td class="text-center">
                                                {{-- <a class="btn btn-secondary btn-sm" href="{{ url('approvisionnement/commission/'.$commission->numero_a) }}"><i class="fa fa-cloud-upload"></i></a> --}}
                                                <a class="btn btn-warning text-white btn-sm userEdit" data-toggle="modal"  data-target="#edit_role"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-info btn-sm userDelete" href="#" data-toggle="modal"  data-target="#delete_role"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->
        <!-- Add Overtime Modal -->
				<div id="add_overtime" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Ajouter une commission</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{route('add/commission/save')}}" method="POST">
                                    @csrf
									<div class="form-group">
										<label>Commission <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="commission" placeholder="">
									</div>
                                    <div class="form-group">
										<label>Type commission<span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="type_commission" placeholder="">
									</div>
                                    <div class="form-group">
										<label>Pourcentage <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="pourcentage" placeholder="">
									</div>
									<div class="submit-section">
										<button type="submit" class="btn btn-secondary submit-btn">Ajouter</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Overtime Modal -->

				<!-- Edit Overtime Modal -->
				<div id="edit_role" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier rôle</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{ route('roles/update')}}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" id="e_id" name="id" value="">
									<div class="form-group">
										<label>Rôle <span class="text-danger">*</span></label>

											<input class="form-control" id="e_type" type="text" name="role_type">

									</div>
									<div class="submit-section">
										<button type="submit" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Overtime Modal -->

				<!-- Delete Overtime Modal -->
				<div class="modal custom-modal fade" id="delete_role" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Supprimer commission</h3>
									<p>Etes-vous sûr de vouloir annuler cette requêtte?</p>
								</div>
								<div class="modal-btn delete-action">
                                    <form action="{{ route('roles/delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" class="e_id" value="">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary continue-btn submit-btn">Supprimer</button>
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
				<!-- /Delete Overtime Modal -->

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
    {{-- update js --}}
    <script>
        $(document).on('click','.edit_role',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_type').val(_this.find('.type').text());
            $('#e_description').val(_this.find('.description').text());

            // status
            var status = (_this.find(".status").text());
            var _option = '<option selected value="' +status+ '">' + _this.find('.status').text() + '</option>'
            $( _option).appendTo("#e_status");
        });

    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_role',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
