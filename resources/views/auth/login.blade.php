@extends('layouts.default')

@section('content')
<div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo text-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
        </div>
        <div class="text-center">
            <h5>Selamat datang di Platform Balai Latihan Masyarakat Banjarmasin</h5>
            <h6 class="font-weight-light">Silahkan masuk</h6>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Keep me signed in
                </label>
            </div>
            @if (Route::has('password.request'))
                <a class="auth-link text-black" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
        <div class="text-center mt-2 font-weight-light">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Login') }}
            </button>
        </div>
        </form>
        {{-- register --}}
        <div class="text-center mt-4 text-sm font-weight-light">
            Belum Punya Akun? 
            <a href="{{ route('register') }}" class="text-primary">Daftar</a>
        </div>
    </div>
    </div>
</div>
@endsection

