@extends('layouts.log-regist')

@section('main-content')
<section class="text-center pb-5">
    <div style="height: 500px;">
        <img src="{{ asset('images/backgroundsiswago.png') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.7); backdrop-filter: blur(30px);">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body py-5 px-md-5">
            <a href="/" class="text-decoration-none text-white position-absolute top-0 start-0 m-3"><h2><i class="bi bi-arrow-left-circle text-dark"></i></h2></a>
            <h2 class="fw-bold mb-5">Sign In Now</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" placeholder="email" required>
                    <label>Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                <p>Not registered yet? <a href="{{ route('register') }}">Register now!</a></p>
            </form>
        </div>
    </div>
</section>
@endsection



{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-center bg-primary text-white">
                    <h4>{{ __('Login') }}</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-muted">{{ __('Forgot Your Password?') }}</a>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('Login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        background-color: #f8f9fa;
    }
    .card-header {
        border-radius: 10px 10px 0 0;
        padding: 1.5rem;
    }
    .card-body {
        padding: 2rem;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>
@endpush --}}
