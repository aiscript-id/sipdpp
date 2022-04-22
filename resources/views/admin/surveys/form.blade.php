@extends('layouts.admin')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">Form Survey</h4>
            <p class="card-text">Survey Detail</p>
            <hr>
            {{-- form survey --}}
            <form action="{{ $url }}" method="POST">
            @if (@$survey)
                @method('PUT')
            @endif
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nama Survey</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Nama Survey" value="{{ $survey->name ?? old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class=" form-control form-control-sm" id="" cols="30" rows="3">{{ $survey->description ?? old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            {{-- button submit --}}
            <div class="text-right">
                <a href="{{ route('surveys.index') }}" class="btn btn-inverse-secondary btn-sm">Kembali</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
            </form>
        </div>
    </div>
@endsection