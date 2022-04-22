@extends('layouts.user')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Lengkapi Profile</h3>
                    <h6 class="font-weight-normal mb-0">Silahkan lengkapi data diri anda</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 order-1 order-md-2">
            {{-- card profile --}}
            <div class="card mb-4">
                <div class="card-body">
                    <ul class="icon-data-list w-100 text-center mt-3">
                        <li>
                            <img src="{{ $user->getAvatar }}" class="mr-0" alt="user" style="width: 100px!important; height:100px!important">
                            <div class="mt-3">
                                <p class="text-info mb-1">{{ $user->name }}</p>
                                <p class="mb-0">
                                    Terdaftar pada
                                    {{-- created at --}}
                                    {{ $user->created_at->format('d M Y') }}
                                </p>
                                <small>{{ $user->created_at->diffForHumans() }}</small>
                            </div>
                        </li>
                    </ul>

                    {{-- button modal edit password --}}
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-inverse-primary mb-1" data-toggle="modal" data-target="#editPassword">
                            <i class="mdi mdi-key"></i>
                            Ganti Password
                        </button>
                        {{-- ganti foto profile --}}
                        <button type="button" class="btn btn-inverse-primary mb-1" data-toggle="modal" data-target="#editAvatar">
                            <i class="mdi mdi-camera"></i>
                            Ganti Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 order-2 order-lg-1">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Akun Pengguna</h5>
                    {{-- form start --}}
                    <form class="forms-sample" id="formProfile" href="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" placeholder="Nama Lengkap">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" disabled value="{{ $user->email }}" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="email">Telepon / Whatsapp</label>
                        <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $user->phone ?? old('phone') }}" required placeholder="Telepon / WA Aktif">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Data Diri</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="born_place">Tempat lahir</label>
                                <input type="text" class="form-control @error('born_place') is-invalid @enderror" id="born_place" name="born_place" value="{{ $user->born_place ?? old('born_place') }}" placeholder="Tempat Lahir">
                                @error('born_place')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="born_date">Tanggal lahir</label>
                                <input type="date" class="form-control @error('born_date') is-invalid @enderror" id="born_date" name="born_date" value="{{ $user->born_date ?? old('born_date') }}" placeholder="Tanggal Lahir">
                                @error('born_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="">
                                    <option value="">Pilih</option>
                                    <option value="1" {{ ($user->gender == 1) ? 'selected' : '' }}>Pria</option>
                                    <option value="2" {{ ($user->gender == 2) ? 'selected' : '' }}>Wanita</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- form end --}}
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Pekerjaan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="born_place">Status Pekerjaan</label>
                                {{-- select --}}
                                @php
                                    $jobs = new \App\Http\Controllers\UserController;
                                    $jobs = $jobs->getJob();
                                @endphp
                                <select class="form-control  @error('job_status') is-invalid @enderror" name="job_status" id="">
                                    <option value="">Pilih</option>
                                    @foreach ($jobs as $key => $value)
                                        <option value="{{ $value }}" {{ $user->job_status == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('job_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="institute">Sekolah / Perguruan Tinggi / Instansi</label>
                                <input type="text" class="form-control @error('institute') is-invalid @enderror" id="institute" name="institute" value="{{ $user->institute ?? old('institute' )}}" placeholder="Sekolah / Perguruan Tinggi / Instansi">
                                @error('institute')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Alamat</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="born_place">Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi" required>
                                    <option value="{{ $desa->district->city->province->id ?? '' }}">
                                        {{ $desa->district->city->province->name ?? '---Pilih Salah Satu---' }}
                                    </option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota">Kabupaten / Kota</label>
                                <select class="form-control" name="kota" id="kota" required>
                                    <option value="{{ $desa->district->city->id ?? '' }}">
                                        {{ $desa->district->city->name ?? '---Pilih Salah Satu---' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan" required>
                                    <option value="{{ $desa->district->id ?? '' }}">
                                        {{ $desa->district->name ?? '---Pilih Salah Satu---' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <select class="form-control @error('desa_id') is-invalid @enderror" name="desa_id" id="desa" required>
                                    <option value="{{ $desa->id ?? '' }}">
                                        {{ $desa->name ?? '---Pilih Salah Satu---' }}
                                    </option>
                                </select>
                                @error('desa_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- alamat --}}
                    <div class="form-group">
                        <label for="address">Alamat Lengkap</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Alamat Lengkap">{{ $user->address ?? old('address')}}</textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mr-2" id="btnProfile">Submit</button>
                    </div>
                    </form>
                    {{-- form end --}}
                </div>
            </div>
        </div>
    </div>

    {{-- modal uabh password --}}
    <div class="modal fade" id="editPassword" tabindex="-1" role="dialog" aria-labelledby="editPassword" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPassword">Ubah Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="old_password">Password Sekarang</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Password Sekarang">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password Baru">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal ubah foto profile --}}
    <div class="modal fade" id="editAvatar" tabindex="-1" role="dialog" aria-labelledby="editAvatar" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAvatar">Ubah Avatar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" placeholder="Avatar">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @section('script')    
        @include('scripts.wilayah')

        {{-- btnProfile Submit  --}}
        <script>
            $('#btnProfile').click(function(e){
                e.preventDefault();
                $('#formProfile').submit();
                $('#btnProfile').html('Loading...');
                $('#btnProfile').attr('disabled', true);
            });
        </script>
    @endsection
    

@endsection