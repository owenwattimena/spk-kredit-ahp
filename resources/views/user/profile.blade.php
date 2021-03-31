@extends('templates.templates')
@section('page', 'PROFILE')
@section('path')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profil</li>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- fixed header  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ubah Profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama</label>
                            <input id="nama" name="nama" value="{{ \Auth::user()->nama }}" type="text"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username</label>
                            <input id="username" name="username" value="{{ \Auth::user()->username }}" type="text"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-controll btn btn-success">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profil.password') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password</label>
                            <input id="password" name="password" type="password" class="form-control" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_baru" class="col-form-label">Password Baru</label>
                            <input id="password_baru" name="password_baru" type="password" class="form-control" required>
                            @error('password_baru')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_baru_confirm" class="col-form-label">Konfirmasi Password Baru</label>
                            <input id="password_baru_confirm" name="password_baru_confirmation" type="password"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-controll btn btn-success">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end fixed header  -->
    <!-- ============================================================== -->
@endsection
