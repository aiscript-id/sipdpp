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
        @if ($event->surveys()->count() > 0)
        <div class="table-responsive mb-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event->surveys as $survey)    
                    <tr>
                        <td class="py-1">
                            <a href="{{ route('surveys.show', $survey->id) }}" class="card-text text-primary" style="text-decoration: none">
                                {{ $survey->name }}
                            </a>
                        </td>
                        <td>{{ $survey->getDate }}</td>
                        <td>
                            {{-- confirm delete --}}
                            <form action="{{ route('events.surveys.destroy', ['survey_id' => $survey->id, 'event_id' => $event->id]) }}" method="POST" class="d-inline show_confirm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-inverse-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else 
            <div class="alert alert-warning">
                Belum ada survey, pilih survey yang akan digunakan untuk event ini. Survey tidak dapat diubah jika sudah dipublish.
            </div>
            {{-- form create survey --}}
            <form action="{{ route('events.surveys.store', ['event_id' => $event->id]) }}" method="post">
            @csrf
            {{-- select survey --}}
            <div class="form-group">
                <label for="">Pilih Survey</label>
                <select name="survey_id" id="" class="form-control">
                    <option value="">Pilih Survey</option>
                    @foreach ($surveys as $survey)
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
        @endif
      </div>
   </div>
@endsection