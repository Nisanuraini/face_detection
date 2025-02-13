@extends('layouts.empty')

@section('main-content')
<section class="text-center pb-5">
    <div style="height: 500px;">
        <img src="{{ asset('img/backgroundsiswago.png') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <div class="card mx-auto shadow-5-strong" style="margin-top: -150px; max-width: 700px; background: hsla(0, 0%, 100%, 0.7); backdrop-filter: blur(30px);">
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
