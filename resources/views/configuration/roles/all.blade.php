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
                        <h3 class="page-title">Rôle</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rôle</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add_overtime"><i class="fa fa-plus"></i> Ajouter un rôle</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Liste des rôles</h4>
                        <p class="card-text">
                            Le tableau ci-dessous affiche la liste de <code>rôles des utilisateurs</code>. Il est possible d'exporter le fchier au format désiré.
                        </p>
                    </div>
                    <div class="card-body">

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-stripped mb-0">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>#</th>
                                            <th>Rôles</th>
                                            <th hidden>Created at</th>
                                            <th >Created at</th>
                                            <th>Updated at</th>
                                            <th class="text-center">Action</th>
                                            {{-- <th class="text-right">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key=>$role )
                                        <tr>
                                            <td>{{$role['id']}}</td>
                                            <td class="type">{{$role->role_type}}</td>
                                            <td hidden class="id">{{ $role->id }}</td>
                                            <td>{{ $role->created_at }}</td>
                                            <td>{{ $role->updated_at }}</td>

                                            <td class="text-center">
                                                <a class="btn btn-secondary btn-sm edit_role" href="#" data-toggle="modal" data-target="#edit_role"><i class="fa fa-pencil "></i> </a>
                                                <a class="btn btn-danger btn-sm delete_role" href="#"  data-toggle="modal" data-target="#delete_role"><i class="fa fa-trash-o "></i></a>
                                              </td>
                                            @endforeach
                                        </tr>

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
								<h5 class="modal-title">Ajouter un rôle</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="{{route('all/roles/save')}}" method="POST">
                                    @csrf
									<div class="form-group">
										<label>Saisir un rôle <span class="text-danger">*</span></label>
										<input class="form-control" type="text" name="role_type" placeholder="Ajouter un rôle au nouveau utilisateur">
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
									<h3>Supprimer rôle</h3>
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
