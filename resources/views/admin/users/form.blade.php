@extends('layouts.admin')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">Form User</h4>
            <p class="card-text">User Account</p>
            <hr>
            {{-- form user --}}
            <form action="{{ $url }}" method="POST">
            @if (@$user)
                @method('PUT')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Nama" value="{{ $user->name ?? old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email" value="{{ $user->email ?? old('email') }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password <small class="text-muted">{{ (@$user) ? '(masukan password baru jika ingin mengubah)' : '' }}</small></label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p class="card-text">User Details</p>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tempat Lahir</label>
                        <input type="text" class="form-control form-control-sm" id="born_place" name="born_place" placeholder="Tempat Lahir" value="{{ $user->born_place ?? old('born_place') }}">
                        @error('born_place')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tanggal Lahir</label>
                        <input type="date" class="form-control form-control-sm" id="born_date" name="born_date" placeholder="Tanggal Lahir" value="{{ $user->born_date ?? old('born_date') }}">
                        @error('born_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- select gender --}}
                @php
                    $gender = ['pria', 'wanita']
                @endphp
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control form-control-sm" name="gender">
                            <option value="">Pilih</option>
                            @foreach ($gender as $g)
                                <option value="{{ $g }}" {{ (@$user->gender == $g) ? 'selected' : '' }}>{{ Str::title($g) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="institute">Institusi / Sekolah</label>
                        <input type="text" class="form-control form-control-sm" id="institute" name="institute" placeholder="Institusi / Sekolah" value="{{ $user->institute ?? old('institute') }}">
                        @error('institute')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="Institusi / Sekolah" value="{{ $user->address ?? old('address') }}">
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div> 
            {{-- button submit --}}
            <div class="text-right">
                <a href="{{ route('users.index') }}" class="btn btn-inverse-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
            </form>
        </div>
    </div>
@endsection