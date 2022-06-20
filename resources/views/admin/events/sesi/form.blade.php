@extends('layouts.admin')
@section('content')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">Form Sesi : {{ $event->name }}</h4>
            <p class="card-text">Sesi Detail</p>
            <hr>
            {{-- form event --}}
            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            @if (@$sesi)
                @method('PUT')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Nama Sesi</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Nama Sesi" value="{{ $sesi->name ?? old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    {{-- select mentor --}}
                    <div class="form-group">
                        <label for="mentor_id">Mentor</label>
                        <select class="form-control form-control-sm" id="mentor_id" name="mentor_id" required>
                            <option value="">Pilih Mentor</option>
                            @foreach ($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ @$sesi->mentor_id == $mentor->id ? 'selected' : '' }}>{{ $mentor->name }}</option>
                            @endforeach
                        </select>
                        @error('mentor_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" id="date" name="date" placeholder="Tanggal" value="{{ $sesi->date ?? old('date') }}" required>
                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_time">Waktu Mulai</label>
                        <input type="time" class="form-control form-control-sm" id="start_time" name="start_time" placeholder="Waktu" value="{{ $sesi->start_time ?? old('start_time') }}" required>
                        @error('start_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_time">Waktu Berakhir</label>
                        <input type="time" class="form-control form-control-sm" id="end_time" name="end_time" placeholder="Waktu" value="{{ $sesi->end_time ?? old('end_time') }}" required>
                        @error('end_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 d-none">
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" class="form-control" />
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <input type="text" class="form-control form-control-sm" id="description" name="description" placeholder="Deskripsi" value="{{ $sesi->description ?? old('description') }}" required>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Materi/Video</h4>
            {{-- select type --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select name="type" id="type" class="form-control form-control-sm" required>
                            <option value="">Pilih Tipe</option>
                            <option value="materi" {{ @$sesi->type == 'materi' ? 'selected' : '' }}>Materi</option>
                            <option value="video" {{ @$sesi->type == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="tugas" {{ @$sesi->type == 'tugas' ? 'selected' : '' }}>Tugas</option>
                        </select>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="content">Content URL</label>
                        <input type="text" class="form-control form-control-sm" id="content" name="content" placeholder="content" value="{{ @$sesi->content ?? old('content') }}">
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- button submit --}}
            <div class="text-right">
                <a href="{{ route('events.show', $event->id) }}" class="btn btn-inverse-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
            </form>
        </div>
    </div>

    @section('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $('.dropify').dropify();
        </script>
    @endsection
@endsection