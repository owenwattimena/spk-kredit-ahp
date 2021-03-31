@extends('templates.templates')
@section('page')
    DATA PENGAJUAN {{ $alternatif->nama }}
@endsection
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item" aria-current="page">AHP</li>
    <li class="breadcrumb-item"><a href="{{ route('ahp.alternatif') }}" class="breadcrumb-link">Alternatif</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pengajuan</li>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Data Pengajuan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ahp.alternatif.pengajuan.post', $alternatif->id) }}" method="POST">
                    @csrf
                    @foreach ($kriteria as $item)
                        <div class="form-group">
                            <label for="{{ $item->id }}" class="col-form-label">{{ $item->nama }}</label>
                            <select id="{{ $item->id }}" name="{{ $item->id }}" class="form-control" required>
                                <option value="">--Pilih {{ $item->nama }}--</option>
                                @foreach ($subkriteria->where('id_kriteria', $item->id)->all() as $item1)
                                    <option
                                        {{ $dataAlternatif->where('id_kriteria', $item->id)->where('id_subkriteria', $item1->id)->first()->id_subkriteria ??
0 == $item1->id
    ? 'selected'
    : '' }}
                                        value="{{ $item1->id }}">{{ $item1->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach

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
