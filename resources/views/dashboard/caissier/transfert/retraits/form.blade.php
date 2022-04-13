
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
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            <img alt="" src="{{ URL::to('/assets/images/'. Auth::user()->avatar) }}">
                        </div>
                        <div class="welcome-det">
                            <h3>FORMULAIRE DE RETRAIT D'ARGENT</h3>
                            <p>Avec Emalafintech, envoyez de l'argent à vos proches en toute sécurité.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('emala.withdrawal') }}" method="POST">
                        @csrf
                        <div class="card-box">
                            <p><b>IDENTITE DU BENEFICIAIRE</b></p>
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Prénom / First and Middle Name <span class="text-danger">*</span></label>
                                    <input name="firstname" class="form-control @error('firstname') is-invalid @enderror" type="text" placeholder="" value="{{ old('firstname') }}">
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nom de famille / Surname/Family Name</label>
                                    <input name="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="" type="text" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Postnom / Middle Name</label>
                                    <input name="middlename" class="form-control @error('middlename') is-invalid @enderror" placeholder="" type="text" value="{{ old('middlename') }}">
                                    @error('middlename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>No. de téléphone de contact<span class="text-danger">*</span></label>
                                    <input name="phone" class="form-control @error('phone') is-invalid @enderror" type="text" placeholder="" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Montant / Amount</label>
                                    <input name="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="" type="text" value="{{ old('amount') }}">
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Devise / Currency</label>
                                    <select class="form-control select @error('currency') is-invalid @enderror" name="currency" value="{{ old('currency') }}">
                                        <option >Devise</option>
                                        <option value="CDF">{{__('CDF')}}</option>
                                        <option value="USD">{{__('USD')}}</option>
                                    </select>
                                    @error('currency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Référence / Transaction Id</label>
                                    <input name="transaction_id" class="form-control @error('transaction_id') is-invalid @enderror" placeholder="" type="text" value="{{ old('transaction_id') }}">
                                    @error('transaction_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">VERIFICATION DE LA TRANSACTION</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
