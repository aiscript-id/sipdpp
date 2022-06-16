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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset($event->image) }}" alt="{{ $event->name }}" class="img-fluid w-100 mb-3 rounded">
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
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            {{-- image --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">{{ $event->name }}</h4>
                            <p class="card-text">{{ $event->description }}</p>
                            
                        </div>
                    </div>
                </div>
            </div>

            {{-- card survey --}}
            {{-- <h4 class="card-title">Survey</h4> --}}
            @if ($event->date .' '. $event->end_time  >= date('Y-m-d H:i:s'))
            @forelse ($surveys as $survey)
            <div class="card mb-2">
                <div class="card-body">
                    {{--  --}}
                    {{-- d-flex fields count and button --}}
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">{{ $survey->name }}</h4>
                        <div class="">
                            <span class="badge badge-pill badge-outline-primary">{{ $survey->fields->count() }} Pertanyaan</span>
                        </div>
                    </div>
                    @php
                        $my_survey = $survey->survey_user->where('user_id', Auth::user()->id)->first();
                    @endphp
                    @if (!@$my_survey)
                        
                    <a href="{{ route('user.surveys.join', ['slug' => $event->slug, 'slug_survey' => $survey->slug]) }}" class="btn btn-primary btn-sm">Lihat Survey</a>
                    @else
                    <p>Anda telah menyelesaikan survey ini</p>
                    <a href="{{ route('user.surveys.join', ['slug' => $event->slug, 'slug_survey' => $survey->slug]) }}" class="btn btn-primary btn-sm">Lihat Jawaban</a>
                    @endif
                    
                </div>
            </div>
            @empty
            <div class="card mb-2">
                <div class="card-body">
                    <p class=" mb-0">Mohon maaf, survey belum tersedia </p>
                </div>
            </div>
            @endforelse
            @else
            <div class="card mb-2">
                <div class="card-body">
                    <p class=" mb-0">Mohon maaf, survey belum tersedia </p>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection