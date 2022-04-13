
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
                                <h3 class="page-title">Debit</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <form action="{{ route('debit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Méthode <span class="text-danger">*</span></label>
                                    <select class="form-control select @error('method') is-invalid @enderror" name="method" value="{{ old('method') }}">
                                        <option value="mpesa">M-Pesa</option>
                                        <option value="airtel">Airtel money</option>
                                        <option value="orange">Orange money</option>
                                    </select>
                                    @error('method')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Devise <span class="text-danger">*</span></label>
                                    <select class="form-control select @error('currency') is-invalid @enderror" name="currency" value="{{ old('currency') }}">
                                        <option value="USD">Dollars</option>
                                        <option value="CDF">Franc congolais</option>
                                    </select>
                                    @error('currency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Root <span class="text-danger">*</span></label>
                                    <select class="form-control select @error('root') is-invalid @enderror" name="root" value="{{ old('root') }}">
                                        <option value="maishapay">Maishapay</option>
                                        <option value="equitybank">Equity</option>
                                        <option value="bgfibank">BGFI</option>
                                    </select>
                                    @error('root')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Numéro de téléphone</label>
                                    <input name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Prénom de l'agent" type="text" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Montant</label>
                                    <input name="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="xxx-xxx-xxx" type="text" value="{{ old('amount') }}">
                                    @error('amount')
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
