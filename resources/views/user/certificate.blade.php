@extends('layouts.user')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Sertifikat Anda </h3>
                    <h6 class="font-weight-normal mb-0">Sistem Informasi Pelatihan <span class="text-primary">Balai Teknologi Informasi dan Komunikasi Pendidikan</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($certificates as $certificate)
            <div class="col-md-4">
                <div class="card border">
                    <div class="card-body ">
                        <h4 class="card-title mb-0">Sertifikat</h4>
                        <small>{{ $certificate->no_certificate }}</small>
                        <p class="card-text mb-2">{{ $certificate->name }}</p>
                        <br>
                        {{-- date --}}

                        <a href="{{ route('certificates.show', $certificate->id) }}" class="btn btn-inverse-success btn-block btn-sm" target="_blank">
                            <i class="mdi mdi-certificate mr-2"></i>Unduh Sertifikat
                        </a>
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse
    </div>
@endsection