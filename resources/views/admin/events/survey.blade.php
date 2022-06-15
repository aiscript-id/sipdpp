@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
           <h4 class="card-title">Survey Event</h4>
        </div>
        <p class="card-description">
            {{ $event->name }}
        </p>
        {{-- form create survey --}}
        <form action="{{ route('events.surveys.store', ['event_id' => $event->id]) }}" method="post">
            @csrf
            {{-- select survey --}}
            <div class="form-group">
                <label for="">Pilih Survey</label>
                <select name="survey_id" id="" class="form-control">
                    <option value="">Pilih Survey</option>
                    @foreach ($all_surveys as $survey)
                        <option value="{{ $survey->id }}">{{ $survey->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- submit --}}
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
            </div>
            </form>
        
        
        @if ($event->surveys()->count() > 0)
        @else 
            <div class="alert alert-warning">
                Belum ada survey, pilih survey yang akan digunakan untuk event ini. Survey tidak dapat diubah jika sudah dipublish.
            </div>
        @endif
      </div>
   </div>


   @foreach ($event->surveys as $survey)    
   <div class="card mt-2">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">{{ $survey->name }}</h4>
                <div class="">
                    <span class="badge badge-pill badge-outline-primary">{{ $survey->fields->count() }} Pertanyaan</span>
                    <form action="{{ route('events.surveys.destroy', ['survey_id' => $survey->id, 'event_id' => $event->id]) }}" method="POST" class="d-inline show_confirm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-inverse-danger">
                            <i class="mdi mdi-delete text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
            {{-- dikerjakan oleh --}}
            <div class="d-flex justify-content-between">
                <p class="card-description">
                    Dikerjakan oleh: {{ $survey->survey_user->count() ?? 0 }} orang
                    <br>
                    <small>Klik pertanyaan untuk melihat jawaban</small>
                </p>
            </div>

            {{-- foreach --}}
            @foreach ($survey->fields as $field)

            <div class="mb-3">
                {{-- badge --}}
                <a href="{{ route('events.surveys.fields', ['field' => $field->id, 'event' => $event->id]) }}" class="text-decoration-none">
                    <div class="alert alert-primary">
                        <i class="mdi mdi-eye text-sm"></i>
                        {{ $field->question }}
                    </div>
                </a>
                {{-- <p class="">{{ $field->question }}</p> --}}
                {{-- list all answer --}}
                {{--  --}}

            </div>

            @endforeach

            {{-- list field --}}


        </div>
   </div>
   @endforeach

@endsection