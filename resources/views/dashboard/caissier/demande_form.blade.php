
@extends('layouts.caissier')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Sidebar -->
    @include('layouts.ca_sidebar')
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Envoyer une demande d'approvisionnement</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <form action="{{ route('management.caissier.create') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Devise <span class="text-danger">*</span></label>
                                    <input name="nom" class="form-control @error('nom') is-invalid @enderror" type="text" placeholder="Insérer le nom de l'agent" value="{{ old('nom') }}">
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Montant</label>
                                    <input name="prenom" class="form-control @error('prenom') is-invalid @enderror" placeholder="Prénom de l'agent" type="text" value="{{ old('prenom') }}">
                                    @error('prenom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Motif de la demande</label>
                                    <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" placeholder="adresse complète de l'agent" type="text" value="{{ old('adresse') }}"></textarea>
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Envoyez la demande</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
