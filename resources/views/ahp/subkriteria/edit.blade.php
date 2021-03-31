@extends('templates.templates')
@section('page', 'AHP-SUB KRITERIA')
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page">AHP</li>
    <li class="breadcrumb-item"><a href="{{ route('ahp.subkriteria') }}" class="breadcrumb-link">Sub Kriteria</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Sub Kriteria</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ahp.subkriteria.put', $subkriteria->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="id_kriteria" class="col-form-label">Kriteria</label>
                        <select id="id_kriteria" name="id_kriteria" class="form-control" required>
                            @foreach ($kriteria as $item)
                                <option {{ $subkriteria->id_kriteria == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Sub Kriteria</label>
                        <input id="nama" name="nama" value="{{ $subkriteria->nama }}" type="text" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="bobot" class="col-form-label">Bobot</label>
                        <input id="bobot" name="bobot" value="{{ $subkriteria->bobot }}" type="number"
                            class="form-control" required>
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
