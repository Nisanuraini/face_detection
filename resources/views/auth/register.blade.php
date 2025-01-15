@extends('layouts.log-regist')

@section('main-content')
<section class="text-center pb-5">
    <div style="height: 500px;">
        <img src="{{ asset('images/backgroundsiswago.png') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.7); backdrop-filter: blur(30px);">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body py-5 px-md-5">
            <a href="/" class="text-decoration-none text-white position-absolute top-0 start-0 m-3"><h2><i class="bi bi-arrow-left-circle text-dark"></i></h2></a>
            <h2 class="fw-bold mb-5">Register Now</h2>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    <label>Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <label>Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <label>Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    <label>Confirm Password</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
                <p>Already registered? <a href="{{ route('login') }}">Sign in now!</a></p>
            </form>
        </div>
    </div>
</section>
@endsection


{{-- @section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">
        <div class="card-body">
            <h3 class="text-center mb-4 text-primary">{{ __('Register') }}</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary text-decoration-none">{{ __('Login') }}</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}
