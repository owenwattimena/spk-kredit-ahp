@extends('templates.templates')
@section('page', 'AHP-KRITERIA')
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page">AHP</li>
    <li class="breadcrumb-item"><a href="{{ route('ahp.kriteria') }}" class="breadcrumb-link">Kriteria</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tambah Kriteria</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ahp.kriteria.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Kriteria</label>
                        <input id="nama" name="nama" type="text" class="form-control" required>
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
