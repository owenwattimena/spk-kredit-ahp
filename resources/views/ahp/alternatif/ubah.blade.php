@extends('templates.templates')
@section('page', 'AHP-ALTERNATIF')
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page">AHP</li>
    <li class="breadcrumb-item"><a href="{{ route('ahp.alternatif') }}" class="breadcrumb-link">Alternatif</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Alternatif</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ahp.alternatif.put', $alternatif->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <input id="nama" name="nama" value="{{ $alternatif->nama }}" type="text" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="no_ktp" class="col-form-label">No KTP</label>
                        <input id="no_ktp" name="no_ktp" value="{{ $alternatif->no_ktp }}" type="text"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin" class="col-form-label">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                            <option {{ $alternatif->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }} value="Laki-laki">
                                Laki-laki</option>
                            <option {{ $alternatif->jenis_kelamin == 'Perempuan' ? 'selected' : '' }} value="Perempuan">
                                Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-controll btn btn-success">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end fixed header  -->
    <!-- ============================================================== -->
@endsection
