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
        
        <div class="col-lg-6 mb-md-4">
            @if (@$event_user->certificate && $event_user->certificate->status == 'approved')
                <div class="card mb-3 shadow">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title mb-0">Selamat !</h4>
                            <p class="card-text">Sertifikat anda telah tersedia</p>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('certificates.show', $event_user->certificate->id) }}" class="btn btn-inverse-success btn-sm" target="_blank">
                                <i class="mdi mdi-certificate mr-2"></i>Unduh Sertifikat
                             </a>
                        </div>
                    </div>
                  </div>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset($event->image) }}" alt="{{ $event->name }}" class="img-fluid w-100 mb-3 rounded">
                    <div class="row">
                        <div class="col-4">
                            <p class="card-text">
                                <i class="mdi mdi-calendar-clock"></i> {{ $event->date }}
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="card-text">
                                <i class="mdi mdi-clock"></i> {{ $event->start_time }} - {{ $event->end_time }}  
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="card-text">
                                <i class="mdi mdi-map-marker"></i> {{ $event->location }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- image --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">{{ $event->name }}</h4>
                            <p class="card-text">{{ $event->description }}</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">

            {{-- card sesi --}}

            @forelse ($sesis as $sesi)
            <div class="card card-{{ ($sesi->type == 'tugas') ? 'dark-blue' : 'tale' }} mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="card-title mb-3 text-white">{{ $sesi->name }}</p>
                            {{-- mentor --}}
                            <div class="d-flex MB-2">
                                <img src="{{ $sesi->mentor->getImage ?? 'https://via.placeholder.com/150' }}" alt="{{ $sesi->mentor->name ?? '-' }}" class="rounded-circle mr-2" width="30" height="30">
                                {{-- name --}}
                                <p class="mt-1">
                                   {{ $sesi->mentor->name ?? '-' }}
                                </p>
                             </div>
                            <p class="card-text">{{ $sesi->description }}</p>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <small class="">
                                        <i class="mdi mdi-calendar-clock"></i> {{ $sesi->date }}
                                    </small>
                                </div>
                                <div class="col-4">
                                    <small class="">
                                        <i class="mdi mdi-clock"></i> {{ $sesi->start_time }} - {{ $sesi->end_time }}
                                    </small>
                                </div>
                            </div>
                            @if ($sesi->type == 'tugas')

                            {{-- {{ $sesi->nilai }} --}}
                            @if (@$sesi->myTugas())
                            {{-- alert --}}
                            <div class="badge bsdge-md badge-success mb-2 font-weight-semibold " role="alert">
                                <strong>Selamat!</strong> Anda telah menyelesaikan tugas ini.
                            </div>
                            <br>
                            <a href="{{ $sesi->myTugas()->test }}" target="_blank"  class="mb-4 btn btn-info btn-sm">Lihat Jawaban</a>

                            @endif

                            {{-- input tugas form --}}
                            <form action="{{ route('user.tugas.store', ['sesi_id' => $sesi->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Kirim Jawaban Tugas</label>
                                    <div class="input-group col-xs-12">
                                      <input type="text" class="form-control form-control-sm" name="test"  placeholder="Input link tugas disini">
                                      <span class="input-group-append">
                                        <button class="btn-sm btn btn-primary" type="submit">Upload</button>
                                      </span>
                                    </div>
                                </div>
                            </form>

                            @elseif ($sesi->type == 'materi')
                                <a href="{{ $sesi->content }}" target="_blank" class="btn btn-sm btn-primary">Lihat Materi</a>
                            @elseif ($sesi->type == 'video')
                            {{-- button modal video --}}
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-video-{{ $sesi->id }}">Lihat Video</button>


                            {{-- modal video --}}
                            <div class="modal fade" id="modal-video-{{ $sesi->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-video-{{ $sesi->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="modal-video-{{ $sesi->id }}">{{ $sesi->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-4 w-100">
                                                    <div style="max-width: 100%" >
                                                      {!! $sesi->content !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @empty
            <div class="card mb-2">
                <div class="card-body">
                    <p class=" mb-0">Mohon maaf, sesi belum tersedia </p>
                </div>
            </div>
            @endforelse

            {{-- card survey --}}
            {{-- <h4 class="card-title">Survey</h4> --}}
            @if ($event->end_date .' '. $event->end_time  <= date('Y-m-d H:i'))
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