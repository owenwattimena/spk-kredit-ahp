@extends('templates.templates')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endsection
@section('page', 'AHP-ALTERNATIF')
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">AHP</li>
    <li class="breadcrumb-item active" aria-current="page">Alternatif</li>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Data Alternatif</h5>
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="{{ route('ahp.alternatif.tambah') }}" class="btn btn-primary btn-sm rounded-0"><i
                            class="fas fa-user-cog"></i>
                        TAMBAH
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No KTP</th>
                                <th>Jenis Kelamin</th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($alternatif as $item)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    <th>{{ $item->nama }}</th>
                                    <th>{{ $item->no_ktp }}</th>
                                    <th>{{ $item->jenis_kelamin }}</th>
                                    <td>
                                        <a href="{{ route('ahp.alternatif.pengajuan', $item->id) }}"
                                            class="btn btn-success btn-sm rounded-0"><i class="fas fa-user-cog"></i>
                                            PENGAJUAN
                                        </a>
                                        <a href="{{ route('ahp.alternatif.ubah', $item->id) }}"
                                            class="btn btn-warning btn-sm rounded-0"><i class="fas fa-user-cog"></i>
                                            UBAH
                                        </a>
                                        <form action="{{ route('ahp.alternatif.hapus', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit"
                                                class="btn btn-danger btn-sm">HAPUS</button>
                                        </form>
                                    </td>
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
