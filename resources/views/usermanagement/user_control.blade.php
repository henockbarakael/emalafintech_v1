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
                        <h3 class="page-title">Gestion des utilisateurs</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Utilisateur</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- /Search Filter -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Liste des utilisateurs du sytème</h4>
                        <p class="card-text">Chef d'agences
                            Le tableau ci-dessous affiche la liste des différents <code>utilisateurs</code>. Il est possible d'exporter le fchier au format désiré.
                        </p>
                    </div>
                    <div class="card-body" style="margin: 0px">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped" id="example">
                            <thead>
                                <tr class="table-primary">

                                    <th>Nom complet</th>
                                    <th hidden>Nom complet</th>
                                    <th>Identifiant</th>
                                    <th>E-mail</th>
                                    <th>Téléhone</th>
                                    <th>Role</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $key=>$user )
                                <tr>
                                    <td>
                                        <span hidden class="image">{{ $user->avatar}}</span>
                                        <h2 class="table-avatar">
                                            <a href="#" class="avatar"><img src="{{ URL::to('/assets/images/'. $user->avatar) }}" alt="{{ $user->avatar }}"></a>
                                            <a href="#" >{{ $user->firstname." ". $user->name}}</span></a>
                                            <a hidden href="#" class="name">{{ $user->name}}</span></a>
                                            <a hidden href="#" class="firstname">{{ $user->firstname}}</span></a>
                                        </h2>
                                    </td>
                                    <td hidden class="id">{{ $user->id }}</td>

                                    <td class="rec_id">{{ $user->rec_id }}</td>
                                    <td class="email">{{ $user->email }}</td>
                                    <td class="telephone">{{ $user->telephone}}</td>
                                    <td>
                                        @if ($user->role_name=='Admin')
                                            {{-- <span class="badge bg-inverse-danger role_name">{{ $user->role_name }}</span>
                                            @elseif ($user->role_name=='Super Admin') --}}
                                            <span class="badge bg-inverse-warning role_name">{{ $user->role_name }}</span>
                                            @elseif ($user->role_name=='Gérant')
                                            <span class="badge bg-inverse-info role_name">{{ $user->role_name }}</span>
                                            @elseif ($user->role_name=='Caissier')
                                            <span class="badge bg-inverse-success role_name">{{ $user->role_name }}</span>
                                            @elseif ($user->role_name=='Client')
                                            <span class="badge bg-inverse-dark role_name">{{ $user->role_name }}</span>
                                        @endif
                                    </td>


                                    <td class="text-right">

                                                <a class="btn btn-info btn-sm edit_user" data-toggle="modal"  data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i></a>
                                                <a class="btn btn-danger btn-sm userDelete" href="#" data-toggle="modal"  data-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i></a>

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


        <!-- Ajouter un utilisateur Modal -->
        <div id="add_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un nouvel utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user/add/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input class="form-control @error('firstname') is-invalid @enderror" type="text" id="" name="firstname" value="{{ old('firstname') }}" placeholder="Entrez votre prénom">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="" name="name" value="{{ old('name') }}" placeholder="Entrez votre nom">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Adresse E-mail</label>
                                    <input class="form-control" type="email" id="" name="email" placeholder="Entrer votre adresse e-mail">
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input class="form-control" type="tel" id="" name="telephone" placeholder="243xxxxxxxxx">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Rôle</label>
                                    <select class="select" name="role_name" id="role_name">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($role_name as $role )
                                        <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Status</label>
                                    <select class="select" name="status" id="status">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($status_user as $status )
                                        <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">

                                <div class="col-sm-12">
                                    <label>Photo</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mot de passe</label>
                                        <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Repeat Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Répétez le mot de passe">
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Ajouter un utilisateur Modal -->

        <!-- Edit User Modal -->
        <div id="edit_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier un utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="modal-body">
                        <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="rec_id" id="e_recid" value="">
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input class="form-control" type="text" name="firstname" id="e_firstname" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input class="form-control" type="text" name="name" id="e_name" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" name="email" id="e_email" value=""/>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input class="form-control" type="text" id="e_telephone" name="telephone" placeholder="243xxxxxxxx">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Rôle</label>
                                    <select class="select" name="role_name" id="e_role_name">
                                        @foreach ($role_name as $role )
                                        <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Status</label>
                                    <select class="select" name="status" id="e_status">
                                        @foreach ($status_user as $status )
                                        <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <label>Position</label>
                                    <select class="select" name="position" id="e_position">
                                        @foreach ($position as $positions )
                                        <option value="{{ $positions->position }}">{{ $positions->position }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                            <br>
                            <div class="row">

                                {{-- <div class="col-sm-6">
                                    <label>Department</label>
                                    <select class="select" name="department" id="e_department">
                                        @foreach ($department as $departments )
                                        <option value="{{ $departments->department }}">{{ $departments->department }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                            <div class="row">

                                <div class="col-sm-12">
                                    <label>Photo</label>
                                    <input class="form-control" type="file" id="image" name="images">
                                    <input type="hidden" name="hidden_image" id="e_image" value="">
                                </div>
                            </div>
                            <br>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Salary Modal -->

        <!-- Delete User Modal -->
        <div class="modal custom-modal fade" id="delete_user" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Supprimer un utilisateur</h3>
                            <p>Vous êtes sûr de vouloir supprimer ?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('user/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="avatar" class="e_avatar" value="">
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
        <!-- /Delete User Modal -->
    </div>
    <!-- /Page Wrapper -->
    @section('script')
    {{-- update js --}}
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print"]
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
        $(document).on('click','.edit_user',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#e_recid').val(_this.find('.rec_id').text());
            $('#e_firstname').val(_this.find('.firstname').text());
            $('#e_name').val(_this.find('.name').text());
            $('#e_email').val(_this.find('.email').text());
            $('#e_telephone').val(_this.find('.telephone').text());
            $('#e_image').val(_this.find('.image').text());

            var name_role = (_this.find(".role_name").text());
            var _option = '<option selected value="' + name_role+ '">' + _this.find('.role_name').text() + '</option>'
            $( _option).appendTo("#e_role_name");

            // var position = (_this.find(".position").text());
            // var _option = '<option selected value="' +position+ '">' + _this.find('.position').text() + '</option>'
            // $( _option).appendTo("#e_position");

            // var department = (_this.find(".department").text());
            // var _option = '<option selected value="' +department+ '">' + _this.find('.department').text() + '</option>'
            // $( _option).appendTo("#e_department");

            var statuss = (_this.find(".statuss").text());
            var _option = '<option selected value="' +statuss+ '">' + _this.find('.statuss').text() + '</option>'
            $( _option).appendTo("#e_status");

        });
    </script>
    {{-- delete js --}}
    <script>
        $(document).on('click','.userDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.e_avatar').val(_this.find('.image').text());
        });
    </script>
    @endsection

@endsection
