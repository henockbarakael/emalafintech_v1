@extends('layouts.master')
@section('content')
{!! Toastr::message() !!}
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            @foreach ($agence as $agence)
                            <img alt="" src="{{ URL::to('/assets/images/'. Auth::user()->avatar) }}">
                        </div>
                        <div class="welcome-det">
                            <h3>Agence : {{ $agence->code_a}}</h3>
                            <p>{{$agence->commune_a." - ".$agence->ville_a }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Page Header -->

                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <strong>Hello {{Auth::user()->name}}!</strong> Vous êtes sur le point de recharger le solde de l'agence {{ $agence->code_a}}.
                                    <br> Veuillez seléctionner la devise puis insérez le montant. Merci! &#128521; &#128521; &#128521;
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->


                    <form action="{{ route('approvisionnement.update') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label>Devise</label>
                            <select class="select" name="currency" id="e_currency" name="currency">
                                <option selected disabled> --Select --</option>
                                <option value="USD">{{ __('Dollars américain') }}</option>
                                <option value="CDF">{{ __('Franc congolais') }}</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">Montant</label>

                                <input name="amount" class="form-control" value="" type="text" placeholder="Insérez un montant">
                                <input hidden name="code_a" class="form-control" value="{{ $agence->code_a}}" type="text">

                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Solde USD</label>
                            <div class="col-lg-9">
                                <input name="solde_usd" class="form-control" value="" type="text" placeholder="Insérez un montant">
                            </div>
                        </div> --}}
                        <div class="submit-section">
                            <button type="submit" class="btn btn-purple submit-btn">RECHARGER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@endsection
