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
                        <h3 class="page-title">Liste de Gérants</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Utilisateur</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Ajouter un gérant</a>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Liste des Chef d'agences</h4>
                        <p class="card-text">
                            Le tableau ci-dessous affiche la liste des responsables des différents <code>agences</code>. Il est possible d'exporter le fchier au format désiré.
                        </p>
                    </div>
                    <div class="card-body" style="margin: 0px">
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped custom-table">
                            <thead>
                                <tr class="table-primary">
                                    <th>Id_Gérant</th>
                                    <th class="text-center">Nom complet</th>
                                    <th class="text-center">Téléhone</th>
                                    <th class="text-center">E-mail</th>
                                    <th hidden>Sexe</th>
                                    <th class="text-center">Id_Agence</th>
                                    <th class="text-center">Password</th>
                                    <th hidden>Action</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$value )
                                <tr>
                                    <td class="code_g">{{ $value->code_g }}</td>
                                    <td class="text-center">{{ $value->prenom." ".$value->nom}}</td>
                                    <td hidden class="ids">{{ $value->id }}</td>
                                    <td class="phone text-center">{{ $value->phone}}</td>
                                    <td class="email text-center">{{ $value->email }}</td>
                                    <td class="sexe text-center" hidden>{{ $value->sexe}}</td>
                                    <td class="agence_id text-center">{{ $value->code_a}}</td>
                                    <td class="text-center">{{ $value->password}}</td>

                                    <td class="text-center">
                                        @if ($value->user_status == "Hors ligne")
                                            <a href="#" class="btn btn-info btn-sm" >Hors ligne</a>
                                            @elseif ($value->user_status == "En ligne")
                                            <a href="#" class="btn btn-success btn-sm" >En ligne</a>
                                            @else
                                            <a href="#" class="btn btn-info btn-sm" >Hors ligne</a>
                                            @endif

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


        <!-- Ajouter un utilisateur Modal -->
        <div id="add_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un gérant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.create.gerant') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Attribuez une agence</label>
                                    <select class="select @error('agence') is-invalid @enderror" name="agence" id="agence" value="{{ old('agence') }}">
                                        <option selected disabled> --Sélectionner --</option>
                                        @foreach ($agences as $agence )
                                        <option value="{{ $agence->code_a }}">{{ $agence->code_a }}</option>
                                        @endforeach
                                    </select>
                                    @error('agence')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input class="form-control @error('prenom') is-invalid @enderror" type="text" id="" name="prenom" value="{{ old('prenom') }}" placeholder="Entrez votre prénom">
                                        @error('prenom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input class="form-control @error('nom') is-invalid @enderror" type="text" id="" name="nom" value="{{ old('nom') }}" placeholder="Entrez votre nom">
                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Adresse E-mail</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" id="" name="email" value="{{ old('email') }}" placeholder="Entrer votre adresse e-mail">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="" value="{{ old('phone') }}" name="phone" placeholder="243 xx xxx xxxx">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Status</label>
                                    <select class="select @error('status') is-invalid @enderror" name="status" id="status" value="{{ old('status') }}">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($status_user as $status )
                                        <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label>Sexe</label>
                                    <select class="select @error('sexe') is-invalid @enderror" name="sexe" id="sexe" value="{{ old('sexe') }}">
                                        <option selected disabled> --Select --</option>
                                        <option value="Masculin"> Masculin</option>
                                        <option value="Féminin"> Féminin</option>
                                    </select>
                                    @error('sexe')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <br>
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
        {{-- <div id="edit_user" class="modal custom-modal fade" role="dialog">
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
                            <input type="hidden" name="code_g" id="e_id" value="">
                            <input type="hidden" name="id" id="e_ids" value="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input class="form-control" type="text" name="prenom" id="e_prenom" value="" />
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
                                        <input class="form-control" type="text" id="e_phone" name="phone" placeholder="243xxxxxxxx">
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
                            </div>
                            <br>
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
        </div> --}}
        <!-- /Edit Salary Modal -->

        <!-- Delete User Modal -->
        {{-- <div class="modal custom-modal fade" id="delete_user" role="dialog">
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
        </div> --}}
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
            $('#e_ids').val(_this.find('.ids').text());
            $('#e_id').val(_this.find('.id').text());
            $('#e_prenom').val(_this.find('.prenom').text());
            $('#e_name').val(_this.find('.name').text());
            $('#e_email').val(_this.find('.email').text());
            $('#e_phone').val(_this.find('.phone').text());
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
