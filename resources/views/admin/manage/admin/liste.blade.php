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
                        <h3 class="page-title">Liste des Administrateurs</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Utilisateurs du système</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Ajouter un admin</a>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->


            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Liste des administrateurs</h4>
                        <p class="card-text">
                            Le tableau ci-dessous affiche la liste des administrateurs du <code>système</code>. Il est possible d'exporter le fchier au format désiré.
                        </p>
                    </div>
                    <div class="card-body" style="margin: 0px">
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped custom-table ">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Id_Gérant</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th hidden>Id</th>
                                        <th>Téléhone</th>
                                        <th>E-mail</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $key=>$value )
                                    <tr>
                                        <td>{{ $value->rec_id }}</td>
                                        <td class="firstname">{{ $value->firstname}}</td>
                                        <td class="name">{{ $value->name}}</td>
                                        <td hidden class="id">{{ $value->id }}</td>
                                        <td class="phone">{{ $value->telephone}}</td>
                                        <td class="email">{{ $value->email }}</td>
                                        <td class="text-center">
                                            @if ($value->user_status == "Hors ligne")
                                            <a href="#" class="btn btn-info btn-sm" >Hors ligne</a>
                                            @elseif ($value->user_status == "En ligne")
                                            <a href="#" class="btn btn-success btn-sm" >En ligne</a>
                                            @else
                                            <a href="#" class="btn btn-info btn-sm" >Hors ligne</a>
                                            @endif

                                        </td>
                                        <td class="text-right">
                                            <a class="btn btn-success btn-sm" href=""><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-info btn-sm edit_user" data-toggle="modal"  data-target="#edit_user"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-sm userDelete" href="#" data-toggle="modal"  data-target="#delete_user"><i class="fa fa-trash-o"></i></a>
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
                        <h5 class="modal-title">Nouveau administrateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.create.admin') }}" method="POST">
                            @csrf
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
                                        @foreach ($type as $status )
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
        <div id="edit_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editer administrateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.update.admin') }}" method="POST">
                        @csrf
                        <input class="form-control" type="hidden" name="id" id="e_id" value="" readonly>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <input class="form-control @error('prenom') is-invalid @enderror" type="text" id="e_prenom" name="prenom" value="" placeholder="Entrez votre prénom">
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
                                    <input class="form-control @error('nom') is-invalid @enderror" type="text" id="e_nom" name="nom" value="" placeholder="Entrez votre nom">
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Adresse E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" id="e_email" name="email" value="" placeholder="Entrer votre adresse e-mail">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="e_phone" value="" name="phone" placeholder="243 xx xxx xxxx">
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
                                <select class="select @error('status') is-invalid @enderror" name="status" id="status" value="">
                                    <option selected disabled> --Select --</option>
                                    @foreach ($type as $status )
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
                                <select class="select @error('sexe') is-invalid @enderror" name="sexe" id="sexe" value="">
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
                            <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            $('#e_prenom').val(_this.find('.firstname').text());
            $('#e_nom').val(_this.find('.name').text());
            $('#e_email').val(_this.find('.email').text());
            $('#e_phone').val(_this.find('.phone').text());

            // var name_role = (_this.find(".role_name").text());
            // var _option = '<option selected value="' + name_role+ '">' + _this.find('.role_name').text() + '</option>'
            // $( _option).appendTo("#e_role_name");

            // var statuss = (_this.find(".statuss").text());
            // var _option = '<option selected value="' +statuss+ '">' + _this.find('.statuss').text() + '</option>'
            // $( _option).appendTo("#e_status");

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
