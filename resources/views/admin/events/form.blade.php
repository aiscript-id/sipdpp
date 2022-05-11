@extends('layouts.admin')
@section('content')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">Form Event</h4>
            <p class="card-text">Event Detail</p>
            <hr>
            {{-- form event --}}
            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            @if (@$event)
                @method('PUT')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Nama Event</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Nama Event" value="{{ $event->name ?? old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" id="date" name="date" placeholder="Tanggal" value="{{ $event->date ?? old('date') }}" required>
                        @error('date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_time">Waktu Mulai</label>
                        <input type="time" class="form-control form-control-sm" id="start_time" name="start_time" placeholder="Waktu" value="{{ $event->start_time ?? old('start_time') }}" required>
                        @error('start_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_time">Waktu Berakhir</label>
                        <input type="time" class="form-control form-control-sm" id="end_time" name="end_time" placeholder="Waktu" value="{{ $event->end_time ?? old('end_time') }}" required>
                        @error('end_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="location">Lokasi</label>
                        <input type="text" class="form-control form-control-sm" id="location" name="location" placeholder="Lokasi Event" value="{{ $event->location ?? old('location') }}" required>
                        @error('location')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
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
                        <textarea name="description" class=" form-control form-control-sm" id="" cols="30" rows="5">{{ $event->description ?? old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            
            {{-- button submit --}}
            <div class="text-right">
                <a href="{{ route('events.index') }}" class="btn btn-inverse-secondary btn-sm">Kembali</a>
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