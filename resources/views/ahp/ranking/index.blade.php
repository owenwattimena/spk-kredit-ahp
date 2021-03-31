@extends('templates.templates')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endsection
@section('page', 'AHP-RANKING')
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">AHP</li>
    <li class="breadcrumb-item active" aria-current="page">Ranking</li>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Data Ranking</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Nasabah</th>
                                @foreach ($kriteria as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($result as $key => $item1)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $item1['alternatif'] }}</td>
                                    @foreach ($item1['pembagianSumBobot'] as $item2)
                                        <td>{{ $item2 }}</td>
                                    @endforeach
                                    <td>{{ $item1['rank'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end fixed header  -->
    <!-- ============================================================== -->
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        if ($("#table").length) {
            $(document).ready(function() {
                var table = $('#table').DataTable({
                    fixedHeader: true
                });
            });
        }

    </script>
@endsection
