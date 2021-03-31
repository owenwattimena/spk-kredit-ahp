@extends('templates.templates')
@section('style')
    <style>
        .border {
            border: 1px green dashed !important;
            margin-top: 10px;
            padding: 10px;
        }

    </style>
@endsection
@section('page', 'AHP-MATRIX')
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">AHP</li>
    <li class="breadcrumb-item active" aria-current="page">Matrix</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Input Data Matrix</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ahp.matrix.post') }}" method="POST" class="form-inline">
                    @csrf
                    <label class="sr-only" for="baris">BARIS</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="padding-bottom: 5px">BARIS</div>
                        </div>
                        <select class="custom-select" id="baris" name="baris" required>
                            <option value="">---PILIH KRITERIA---</option>
                            @foreach ($kriteria as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label class="sr-only" for="kolom">KOLOM</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="padding-bottom: 5px">KOLOM</div>
                        </div>
                        <select class="custom-select" id="kolom" name="kolom" required>
                            <option value="">---PILIH KRITERIA---</option>
                            @foreach ($kriteria as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="sr-only" for="bobot">BOBOT</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text" style="padding-bottom: 5px">BOBOT</div>
                        </div>
                        <select class="custom-select" id="bobot" name="bobot" required>
                            <option value="">---PILIH BOBOT---</option>
                            @for ($i = 1; $i < 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2 btn-sm"
                        style="padding-bottom: 6px; padding-top:7px;">SIMPAN</button>
                </form>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Data Matrix</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>KRITERIA</th>
                                @foreach ($kriteria as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $key => $item)
                                <tr>
                                    <th>{{ $item->nama }}</th>
                                    @foreach ($matrix[$key] as $key2 => $item2)
                                        <td class="text-center">{{ $item2 }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfood>
                            <tr>
                                <th class="text-success">JUMLAH</th>
                                @foreach ($total_matrix as $item)
                                    <th class="bg-default text-center">{{ $item }}</th>
                                @endforeach
                            </tr>
                        </tfood>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end fixed header  -->
    <!-- ============================================================== -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                NILAI EIGEN
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nilai Eigen</th>
                                @foreach ($kriteria as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $key1 => $item1)
                                <tr>
                                    <th>{{ $item1->nama }}</th>
                                    @foreach ($nilai_eigen[$key1] as $key2 => $item2)
                                        <td>{{ $item2 }}</td>
                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">PRIORITAS</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>KRITERIA</th>
                                <th>Jumlah</th>
                                <th>Prioritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriteria as $key => $item)
                                <tr>
                                    <th>{{ $item->nama }}</th>
                                    <td>{{ $jumlah_eigen[$key] }}</td>
                                    <td>{{ $prioritas[$key] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfood>
                            <tr>
                                <th>Jumlah</th>
                                <th>
                                    {{ collect($jumlah_eigen)->sum() }}
                                </th>
                                <th>
                                    {{ collect($prioritas)->sum() }}
                                </th>
                            </tr>
                        </tfood>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        PERINGKAT
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>Peringkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($sort as $key => $item)
                                        <tr>
                                            <td>{{ $item['kriteria'] }}</td>
                                            <th>{{ ++$no }}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        KONSISTENSI
                    </div>
                    <div class="card-body">
                        <div class="border">
                            {!! $konsistensi['ci'] > 0.1 ? '<small class="text-danger">Tidak Konsisten</small>' : '<small class="text-success">Konsisten</small>' !!}
                            <h4>CI = {{ $konsistensi['ci'] }} </h4>
                        </div>

                        <div class="border">
                            {!! $konsistensi['cr'] > 0.1 ? '<small class="text-danger">Tidak Konsisten</small>' : '<small class="text-success">Konsisten</small>' !!}
                            <h4>CR = {{ $konsistensi['cr'] }} </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
