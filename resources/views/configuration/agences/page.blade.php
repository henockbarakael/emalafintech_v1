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
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Gestion des agences</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Agence</a>
                            </li>
                            <li class="breadcrumb-item">@foreach ($resulta as $resulta)
                                {{ $resulta->code}}
                                @endforeach</li>
                            <li class="breadcrumb-item active">Vue globale</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Approvisionner</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-briefcase" style="color:darkgreen"></i></span>
                            <div class="dash-widget-info">
                                <h3 style="font-size: 14px">{{$ouverture}}</h3>
                                <span>Ouverture</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-briefcase" style="color:purple"></i></span>
                            <div class="dash-widget-info">
                                <h3 style="font-size: 14px">{{$cloture}}</h3>
                                <span>Clôture</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-money" style="color:rgb(31, 31, 110)"></i></span>
                            <div class="dash-widget-info">
                                <h3 style="font-size: 14px">{{$usd}}</h3>
                                <span>Caisse en USD</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-money"></i></span>
                            <div class="dash-widget-info">
                                <h3 style="font-size: 14px">{{$cdf}}</h3>
                                <span>Caisse en CDF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Resumé</h3>
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title text-center">Dernières transactions</h3>
                                    <ul class="list-group">
                                          <li class="list-group-item list-group-item-action">UI Developer <span class="float-right text-sm text-muted">1 Hours ago</span></li>
                                          <li class="list-group-item list-group-item-action">Android Developer <span class="float-right text-sm text-muted">1 Days ago</span></li>
                                          <li class="list-group-item list-group-item-action">IOS Developer<span class="float-right text-sm text-muted">2 Days ago</span></li>
                                          <li class="list-group-item list-group-item-action">PHP Developer<span class="float-right text-sm text-muted">3 Days ago</span></li>
                                          <li class="list-group-item list-group-item-action">UI Developer<span class="float-right text-sm text-muted">3 Days ago</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>E-mail</th>
                                    <th>Adresse</th>
                                    <th>Détails</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="code"></td>
                                </tr>
                            </tbody>
                        </table>
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
                        <h5 class="modal-title">Approvisionner {{ $resulta->code}}</h5>
                        @php
                            $code = $resulta->code;
                        @endphp
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('up/approvisionnement')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Choisir une devise</label>
                                    <select class="select" name="devise" id="devise">
                                        <option selected disabled> --Select --</option>
                                        <option value="USD">{{ __('Dollar (USD)') }}</option>
                                        <option value="CDF">{{ __('Franc congolais (FC)') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <div class="form-group">
                                        <label>Montant</label>
                                        <input class="form-control @error('montant') is-invalid @enderror" type="text" id="montant" name="montant" value="{{ old('montant') }}" placeholder="Insérez un montant">
                                        <input type="hidden" id="code" name="code" value="{{ $resulta->code}}">
                                        @error('montant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <div class="form-group">
                                        <label>Code Agent</label>
                                        <input class="form-control @error('agent') is-invalid @enderror" type="text" id="agent" name="agent" value="{{ old('agent') }}" placeholder="Saisissez votre code">
                                        @error('agent')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-secondary ">VALIDER LE TRANSFERT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Ajouter une agence Modal -->

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
        $(document).on('click','.edit_user',function()
        {
            var _this = $(this).parents('tr');
            $('#e_code').val(_this.find('.code').text());
            $('#e_id').val(_this.find('.id').text());
            $('#e_nom').val(_this.find('.nom').text());
            $('#e_avenue').val(_this.find('.avenue').text());
            $('#e_email').val(_this.find('.email').text());
            $('#e_telephone').val(_this.find('.telephone').text());

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
