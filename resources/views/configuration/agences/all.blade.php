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
                        <h3 class="page-title">Gestion des agences</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Agence</a></li>
                            <li class="breadcrumb-item active">Liste</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Ajouter une agence</a>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->


            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Liste des agences</h4>
                        <p class="card-text">
                            Le tableau ci-dessous affiche la liste des <code>agences</code>. Il est possible d'exporter le fchier au format désiré.
                        </p>
                    </div>
                    <div class="card-body" style="margin: 0px">
                    <div class="table-responsive">
                        <table id="example1" class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>Id_Agence</th>
                                    <th class="text-right">Téléphone</th>
                                    <th hidden class="text-right">Téléphone</th>
                                    <th class="text-right">E-mail</th>
                                    <th class="text-right">Commune</th>
                                    <th class="text-right">Ville</th>
                                    <th class="text-center">Solde USD</th>
                                    <th class="text-center">Solde CDF</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agences as $key=>$agence )
                                <tr>
                                    <td class="code">{{ $agence->code_a }}</td>
                                    <td hidden class="id">{{ $agence->id }}</td>
                                    <td class="phone text-right">{{ $agence->numero_a }}</td>
                                    <td class="email text-right">{{ $agence->email_a }}</td>
                                    <td class="commune text-right">{{ $agence->commune_a}}</td>
                                    <td class="ville text-right">{{ $agence->ville_a }}</td>
                                    <td class="cdf text-center">{{ $agence->solde_cdf}}</td>
                                    <td class="usd text-center">{{ $agence->solde_usd}}</td>
                                    <td class="text-center">
                                        {{-- <a class="btn btn-secondary btn-sm" href="{{ url('approvisionnement/agence/'.$agence->numero_a) }}"><i class="fa fa-cloud-upload"></i></a> --}}
                                        <a class="btn btn-warning text-white btn-sm userEdit" data-toggle="modal"  data-target="#edit_user"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-info btn-sm userDelete" href="#" data-toggle="modal"  data-target="#delete_user"><i class="fa fa-trash-o"></i></a>
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


        <!-- Ajouter une agence Modal -->
        <div id="add_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une agence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('add/agence/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Téléphone de l'agence</label>
                                        <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Téléphonde de l'agence">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Province</label>
                                        <input class="form-control @error('province') is-invalid @enderror" type="text" id="province" name="province" value="{{ old('province') }}" placeholder="Nom de la province">
                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Commune</label>
                                    <select class="select" name="commune" id="commune">
                                        <option selected disabled> --Select --</option>
                                        <option value="{{ __('Bandalungwa') }}">{{ __('Bandalungwa') }}</option>
                                        <option value="{{ __('Barumbu') }}">{{ __('Barumbu') }}</option>
                                        <option value="{{ __('Bumbu') }}">{{ __('Bumbu') }}</option>
                                        <option value="{{ __('Gombe') }}">{{ __('Gombe') }}</option>
                                        <option value="{{ __('Kalamu') }}">{{ __('Kalamu') }}</option>
                                        <option value="{{ __('Kasa-Vubu') }}">{{ __('Kasa-Vubu') }}</option>
                                        <option value="{{ __('Kimbanseke') }}">{{ __('Kimbanseke') }}</option>
                                        <option value="{{ __('Kinshasa') }}">{{ __('Kinshasa') }}</option>
                                        <option value="{{ __('Kintambo') }}">{{ __('Kintambo') }}</option>
                                        <option value="{{ __('Kisenso') }}">{{ __('Kisenso') }}</option>
                                        <option value="{{ __('Lemba') }}">{{ __('Lemba') }}</option>
                                        <option value="{{ __('Limete') }}">{{ __('Limete') }}</option>
                                        <option value="{{ __('Lingwala') }}">{{ __('Lingwala') }}</option>
                                        <option value="{{ __('Makala') }}">{{ __('Makala') }}</option>
                                        <option value="{{ __('Maluku') }}">{{ __('Maluku') }}</option>
                                        <option value="{{ __('Masina') }}">{{ __('Masina') }}</option>
                                        <option value="{{ __('Matete') }}">{{ __('Matete') }}</option>
                                        <option value="{{ __('Mont-Ngafula') }}">{{ __('Mont-Ngafula') }}</option>
                                        <option value="{{ __('Ndjili') }}">{{ __('Ndjili') }}</option>
                                        <option value="{{ __('Ngaba') }}">{{ __('Ngaba') }}</option>
                                        <option value="{{ __('Ngaliema') }}">{{ __('Ngaliema') }}</option>
                                        <option value="{{ __('Ngiri-Ngiri') }}">{{ __('Ngiri-Ngiri') }}</option>
                                        <option value="{{ __('Nsele') }}">{{ __('Nsele') }}</option>
                                        <option value="{{ __('Selembao') }}">{{ __('Selembao') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Ville</label>
                                    <select class="select" name="ville" id="ville">
                                        <option selected disabled> --Select --</option>
                                        <option value="{{ __('Kinhsasa') }}">{{ __('Kinhsasa') }}</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-secondary ">Ajouter l'agence</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Ajouter une agence Modal -->

        <!-- Approvionnement Modal -->
        <div id="approvisionnement" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier une agence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="modal-body">
                        <form action="{{ route('agence/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="code" id="e_code" value="">
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input class="form-control" type="text" name="nom" id="e_nom" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input class="form-control" type="text" name="telephone" id="e_telephone" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" name="email" id="e_email" value=""/>
                                </div></div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Rue</label>
                                        <input class="form-control" type="text" id="e_avenue" name="avenue" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Commune</label>
                                    <select class="form-control" name="commune" id="e_commune">
                                        <option selected disabled> --Select --</option>
                                        <option value="{{ __('Bandalungwa') }}">{{ __('Bandalungwa') }}</option>
                                        <option value="{{ __('Barumbu') }}">{{ __('Barumbu') }}</option>
                                        <option value="{{ __('Bumbu') }}">{{ __('Bumbu') }}</option>
                                        <option value="{{ __('Gombe') }}">{{ __('Gombe') }}</option>
                                        <option value="{{ __('Kalamu') }}">{{ __('Kalamu') }}</option>
                                        <option value="{{ __('Kasa-Vubu') }}">{{ __('Kasa-Vubu') }}</option>
                                        <option value="{{ __('Kimbanseke') }}">{{ __('Kimbanseke') }}</option>
                                        <option value="{{ __('Kinshasa') }}">{{ __('Kinshasa') }}</option>
                                        <option value="{{ __('Kintambo') }}">{{ __('Kintambo') }}</option>
                                        <option value="{{ __('Kisenso') }}">{{ __('Kisenso') }}</option>
                                        <option value="{{ __('Lemba') }}">{{ __('Lemba') }}</option>
                                        <option value="{{ __('Limete') }}">{{ __('Limete') }}</option>
                                        <option value="{{ __('Lingwala') }}">{{ __('Lingwala') }}</option>
                                        <option value="{{ __('Makala') }}">{{ __('Makala') }}</option>
                                        <option value="{{ __('Maluku') }}">{{ __('Maluku') }}</option>
                                        <option value="{{ __('Masina') }}">{{ __('Masina') }}</option>
                                        <option value="{{ __('Matete') }}">{{ __('Matete') }}</option>
                                        <option value="{{ __('Mont-Ngafula') }}">{{ __('Mont-Ngafula') }}</option>
                                        <option value="{{ __('Ndjili') }}">{{ __('Ndjili') }}</option>
                                        <option value="{{ __('Ngaba') }}">{{ __('Ngaba') }}</option>
                                        <option value="{{ __('Ngaliema') }}">{{ __('Ngaliema') }}</option>
                                        <option value="{{ __('Ngiri-Ngiri') }}">{{ __('Ngiri-Ngiri') }}</option>
                                        <option value="{{ __('Nsele') }}">{{ __('Nsele') }}</option>
                                        <option value="{{ __('Selembao') }}">{{ __('Selembao') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label>Ville</label>
                                <select class="select" name="ville" id="e_ville">
                                    <option selected disabled> --Select --</option>
                                    <option value="{{ __('Kinhsasa') }}">{{ __('Kinhsasa') }}</option>
                                </select>
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

        <!-- Edit User Modal -->
        <div id="edit_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier une agence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="modal-body">
                        <form action="{{ route('agence/update') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="code" id="e_code" value="">
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Téléphone</label>
                                        <input class="form-control" type="text" name="telephone" id="e_telephone" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" name="email" id="e_email" value=""/>
                                    </div>
                                </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Commune</label>
                                    <select class="select" name="commune" id="e_commune">
                                        <option selected disabled> --Select --</option>
                                        <option value="{{ __('Bandalungwa') }}">{{ __('Bandalungwa') }}</option>
                                        <option value="{{ __('Barumbu') }}">{{ __('Barumbu') }}</option>
                                        <option value="{{ __('Bumbu') }}">{{ __('Bumbu') }}</option>
                                        <option value="{{ __('Gombe') }}">{{ __('Gombe') }}</option>
                                        <option value="{{ __('Kalamu') }}">{{ __('Kalamu') }}</option>
                                        <option value="{{ __('Kasa-Vubu') }}">{{ __('Kasa-Vubu') }}</option>
                                        <option value="{{ __('Kimbanseke') }}">{{ __('Kimbanseke') }}</option>
                                        <option value="{{ __('Kinshasa') }}">{{ __('Kinshasa') }}</option>
                                        <option value="{{ __('Kintambo') }}">{{ __('Kintambo') }}</option>
                                        <option value="{{ __('Kisenso') }}">{{ __('Kisenso') }}</option>
                                        <option value="{{ __('Lemba') }}">{{ __('Lemba') }}</option>
                                        <option value="{{ __('Limete') }}">{{ __('Limete') }}</option>
                                        <option value="{{ __('Lingwala') }}">{{ __('Lingwala') }}</option>
                                        <option value="{{ __('Makala') }}">{{ __('Makala') }}</option>
                                        <option value="{{ __('Maluku') }}">{{ __('Maluku') }}</option>
                                        <option value="{{ __('Masina') }}">{{ __('Masina') }}</option>
                                        <option value="{{ __('Matete') }}">{{ __('Matete') }}</option>
                                        <option value="{{ __('Mont-Ngafula') }}">{{ __('Mont-Ngafula') }}</option>
                                        <option value="{{ __('Ndjili') }}">{{ __('Ndjili') }}</option>
                                        <option value="{{ __('Ngaba') }}">{{ __('Ngaba') }}</option>
                                        <option value="{{ __('Ngaliema') }}">{{ __('Ngaliema') }}</option>
                                        <option value="{{ __('Ngiri-Ngiri') }}">{{ __('Ngiri-Ngiri') }}</option>
                                        <option value="{{ __('Nsele') }}">{{ __('Nsele') }}</option>
                                        <option value="{{ __('Selembao') }}">{{ __('Selembao') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label>Ville</label>
                                <select class="select" name="ville" id="e_ville">
                                    <option selected disabled> --Select --</option>
                                    <option value="{{ __('Kinhsasa') }}">{{ __('Kinhsasa') }}</option>
                                </select>
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
                            <form action="{{ route('agence/delete') }}" method="POST">
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
        $(document).on('click','.userEdit',function()
        {
            var _this = $(this).parents('tr');

            $('#e_id').val(_this.find('.id').text());
            $('#e_code').val(_this.find('.code').text());
            $('#e_telephone').val(_this.find('.phone').text());
            $('#e_email').val(_this.find('.email').text());
            var commune = (_this.find(".commune").text());
            var _option = '<option selected value="' +commune+ '">' + _this.find('.commune').text() + '</option>'
            $( _option).appendTo("#e_commune");

            var ville = (_this.find(".ville").text());
            var _option = '<option selected value="' +ville+ '">' + _this.find('.ville').text() + '</option>'
            $( _option).appendTo("#e_ville");

        });
    </script>
    {{-- approvisionnement js --}}
    <script>
        $(document).on('click','.appro_user',function()
        {
            var _this = $(this).parents('tr');
            $('#e_phone').val(_this.find('.phone').text());
            $('#e_id').val(_this.find('.id').text());
            $('#e_commune').val(_this.find('.commune').text());
            $('#e_ville').val(_this.find('.ville').text());
            $('#e_cdf').val(_this.find('.cdf').text());
            $('#e_usd').val(_this.find('.usd').text());

            var commune = (_this.find(".commune").text());
            var _option = '<option selected value="' +commune+ '">' + _this.find('.commune').text() + '</option>'
            $( _option).appendTo("#e_commune");

            var ville = (_this.find(".ville").text());
            var _option = '<option selected value="' +ville+ '">' + _this.find('.ville').text() + '</option>'
            $( _option).appendTo("#e_ville");

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


