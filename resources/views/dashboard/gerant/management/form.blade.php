
@extends('layouts.gerant')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Sidebar -->
    @include('layouts.ge_sidebar')
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
                                <h3 class="page-title">Ajouter un nouveau agent de caisse</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <form action="{{ route('management.caissier.create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Choisir la caisse <span class="text-danger">*</span></label>
                                    <select class="form-control select @error('code_caisse') is-invalid @enderror" name="id_caisse" value="{{ old('code_caisse') }}">
                                        <option value=""></option>
                                        @foreach ($code_caisse as $code_caisses )

                                        <option value="{{ $code_caisses->id }}">{{ $code_caisses->code_c }}</option>
                                        @endforeach
                                    </select>
                                    @error('code_caisse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nom de l'agent <span class="text-danger">*</span></label>
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
                                    <label>Prénom de l'agent</label>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Numéro de téléphone</label>
                                    <input name="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="xxx-xxx-xxx" type="text" value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Adresse e-mail</label>
                                    <input name="email" class="form-control @error('email') is-invalid @enderror" placeholder="username@domain.com" type="email" value="{{ old('email') }}">
                                    @error('email')
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
                                    <label>Adresse actuelle</label>
                                    <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" placeholder="adresse complète de l'agent" type="text" value="{{ old('adresse') }}"></textarea>
                                    @error('adresse')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Sexe</label>
                                    <select name="sexe" class="form-control select @error('sexe') is-invalid @enderror" value="{{ old('sexe') }}">
                                        <option value="" selected>Définir un sexe</option>
                                        <option value="F">Féminin</option>
                                        <option value="M">Masculin</option>
                                    </select>
                                    @error('sexe')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Ville</label>
                                    <input name="ville" class="form-control @error('ville') is-invalid @enderror" placeholder="saisir la ville de l'agent" type="text" value="{{ old('ville') }}">
                                    @error('ville')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
