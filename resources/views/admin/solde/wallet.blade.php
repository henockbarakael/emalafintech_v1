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
                        <h3 class="page-title">SOLDE WALLET</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Solde</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Liste des wallets</h4>
                        <p class="card-text">
                            Le tableau ci-dessous affiche la liste de <code>Wallets</code> avec leur solde. Il est possible d'exporter le fchier au format désiré.
                            <br>
                            En cliquant sur l'icône <i class="fa fa-cloud-upload"></i>, il est possible de recharger le solde d'un quelconque wallet.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped custom-table">
                                <thead>
                                    <tr class="table-primary">
                                        <th hidden class="text-center">Id</th>
                                        <th>Wallet</th>
                                        <th class="text-left">CDF</th>
                                        <th class="text-left">USD</th>
                                        <th class="text-left">Created at</th>
                                        <th class="text-left">Updated at</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataAll as $dataAll )
                                    <tr>
                                        <td hidden class="id">{{ $dataAll->id }}</td>
                                        <td class="code">{{ $dataAll->balance_for }}</td>
                                        <td class="phone text-left">{{ $dataAll->balance_cdf }}</td>
                                        <td class="commune text-left">{{ $dataAll->balance_usd}}</td>
                                        <td class="ville text-left">{{ $dataAll->created_at }}</td>
                                        <td class="cdf text-left">{{ $dataAll->updated_at}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm" href="{{ url('approvisionnement/wallet/'.$dataAll->id) }}"><i class="fa fa-cloud-upload"></i> Recharger</a>
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
        $(document).on('click','.agenceEdit',function()
        {
            <th hidden class="text-center">Code</th>
                                        <th>Id_Agence</th>
                                        <th class="text-right">Téléphone</th>
                                        <th class="text-right">Commune</th>
                                        <th class="text-right">Ville</th>
                                        <th class="text-center">Solde USD</th>
                                        <th class="text-center">Solde CDF</th>
                                        <th class="text-center">Action</th>
            var _this = $(this).parents('tr');
            // $('#e_code').val(_this.find('.code').text());
            $('#e_id').val(_this.find('.id').text());
            $('#e_code').val(_this.find('.code').text());
            $('#e_telephone').val(_this.find('.telephone').text());
            var commune = (_this.find(".commune").text());
            var _option = '<option selected value="' +commune+ '">' + _this.find('.commune').text() + '</option>'
            $( _option).appendTo("#e_commune");

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
        $(document).on('click','.agenceDelete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection

@endsection


