@extends('layouts.user')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Event dan Pelatihan yang Anda Ikuti</h3>
                    <h6 class="font-weight-normal mb-0">Sistem Informasi Pelatihan <span class="text-primary">Balai Teknologi Informasi dan Komunikasi Pendidikan</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($events as $event)
        <div class="col-md-12 mb-4">
            {{-- image --}}
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset($event->image) }}" alt="{{ $event->name }}" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <h4 class="card-title">{{ $event->name }}</h4>
                            <p class="card-text">{{ $event->description }}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="mdi mdi-calendar-clock"></i> {{ $event->date }}
                                </small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="mdi mdi-clock"></i> {{ $event->start_time }} - {{ $event->end_time }}
                                </small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="mdi mdi-map-marker"></i> {{ $event->location }}
                                </small>
                            </p>
                            <a href="{{ route('user.events.show', ['slug' => $event->slug]) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection