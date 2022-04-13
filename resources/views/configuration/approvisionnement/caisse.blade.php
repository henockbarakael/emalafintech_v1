@extends('layouts.gerant')
@section('content')
{!! Toastr::message() !!}
    <!-- Sidebar -->
    @include('layouts.ge_sidebar')
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

                            <h3>Caisse : {{ $caisse->compte_id}}</h3>
                            <p></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Page Header -->

                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Récharger le compte</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <form action="{{ route('approvisionnement.caisse.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Devise</label>
                            <div class="col-lg-9">
                                <select class="form-control select @error('currency') is-invalid @enderror" name="currency" value="{{ old('currency') }}">
                                    <option value="USD">{{__('Dollars americain')}}</option>
                                    <option value="CDF">{{__('Franc congolais')}}</option>
                                </select>
                                <input hidden name="compte_id" class="form-control" value="{{ $caisse->compte_id}}" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Montant</label>
                            <div class="col-lg-9">
                                <input name="amount" class="form-control" value="" type="text" placeholder="Insérez un montant">
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-purple submit-btn">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@endsection
