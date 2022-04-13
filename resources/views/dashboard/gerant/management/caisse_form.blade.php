
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
                <div class="col-md-8 offset-md-2" style="margin-top: 150px">


                    <form action="{{ route('management.caisse.create') }}" method="POST">
                        @csrf

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Cliquer ici pour créer une caisse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@endsection
