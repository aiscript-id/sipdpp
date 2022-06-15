@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
           <h4 class="card-title">Survey</h4>
        </div>
        <p class="card-description">
            {{ (@$survey) ? 'Survey '.$survey->name : '' }}<br>
            {{ (@$event) ? 'Kegiatan '.$event->name : '' }} 
        </p>
      </div>
   </div>


   <div class="card mt-2">
        <div class="card-body">
            <div class="alert alert-light">
                <p class="mb-0 text-dark">
                    {{ $field->question }}
                </p>
            </div>

            @if (@$most_common_answer)    
            <div class="alert alert-warning">
                <p>
                    <strong>Jawaban yang paling banyak :</strong>
                </p>
                <p>
                    {{ $most_common_answer->answer }}
                    <br>
                    <span class="text-sm">sebanyak {{ $most_common_answer->total }} orang menjawab</span>
                </p>
            </div>
            @endif
            {{-- foreach --}}
            @if ($field->type == 'text')
            
            <div class="row">
                <div class="col-md-3">
                    @foreach ($answers as $answer)
                    <p class="card-description">
                        {{ $loop->iteration }}. {{ $answer->answer }}
                    </p>
                    @if ($loop->iteration % 5 == 0)
                        </div><div class="col-md-6">
                    @endif
                    @endforeach
                </div>
            </div>
                
            @endif

            {{-- list field --}}


        </div>
   </div>

@endsection