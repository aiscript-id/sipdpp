@extends('layouts.user')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
                    <h6 class="font-weight-normal mb-0">Sistem Informasi Pelatihan <span class="text-primary">Balai Pelatihan Masyarakat Kota Banjarmasin</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if (@Auth::user()->verified_at)
                            <div class="col-md-10">
                                <p class="p-0">
                                    {{-- end icon success --}}
                                    <b class="text-success">Anda telah melengkapi data diri. </b><br> Silahkan mengikuti event dan survey yang telah disediakan di Balai Pelatihan Masyarakat Kota Banjarmasin
                                </p>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('user.profile') }}" class="btn btn-primary btn-block">Lihat Data Diri</a>
                            </div>
                        @else
                            <div class="col-md-10">
                                <p class="p-0"><b class="text-warning">Anda belum melengkapi data diri.</b><br> Silahkan lakukan pengisian data diri untuk bergabung ke dalam Event di Balai Pelatihan Masyarakat Kota Banjarmasin</p>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('user.profile') }}" class="btn btn-primary btn-block">Isi Data Diri</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection