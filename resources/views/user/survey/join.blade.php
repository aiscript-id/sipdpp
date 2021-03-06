@extends('layouts.user')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Survey</h3>
                    <h6 class="font-weight-normal mb-0">Sistem Informasi Pelatihan <span class="text-primary">Balai Teknologi Informasi dan Komunikasi Pendidikan</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">

            {{-- card survey --}}
            <div class="card mb-2">
                <div class="card-body">
                    {{--  --}}
                    {{-- d-flex fields count and button --}}
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">{{ $survey->name }}</h4>
                        <div class="">
                            <span class="badge badge-pill badge-outline-primary">{{ $survey->fields->count() }} Pertanyaan</span>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('user.surveys.update', ['survey_user' => $survey_user->id ] ) }}" method="post">
                @csrf
                @method('PUT')
                @foreach ($fields as $field)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group form-group-sm mb-0">
                            <label for=""><b>{{ $loop->iteration }}. {{ $field->field->question }}</b></label>
                            @if ($field->field->type == 'text')
                                <input type="text" class="form-control" required name="{{ $field->field->id }}" value="{{ $field->answer }}" placeholder="Jawaban">
                            @elseif ($field->field->type == 'textarea')
                                <textarea class="form-control" required name="{{ $field->field->id }}" placeholder="Jawaban">{{ $field->answer }}</textarea>
                            @elseif ($field->field->type == 'select')
                                <select class="form-control" required name="{{ $field->field->id }}">
                                    <option value="">Silahkan Pilih</option>
                                    @foreach ($field->field->getOptions as $option)
                                        <option value="{{ $option }}" {{ ($field->answer == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            @elseif ($field->field->type == 'number')
                                <input type="number" class="form-control" min="1" max="10" required name="{{ $field->field->id }}" value="{{ $field->answer }}" placeholder="Jawaban">
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="text-right">
                    {{-- back --}}
                    <a href="{{ route('user.events.show', ['slug' => $event->slug]) }}" class="btn btn-outline-secondary">Kembali</a>
                    {{-- submit --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

            </form> 



        </div>
    </div>
@endsection