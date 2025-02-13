@extends('layouts.empty')

@section('main-content')
<section class="text-center pb-5">
    <div style="height: 500px;">
        <img src="{{ asset('img/backgroundsiswago.png') }}" alt="Background" style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <div class="card mx-auto shadow-5-strong" style="margin-top: -150px; max-width: 1000px; background: hsla(0, 0%, 100%, 0.7); backdrop-filter: blur(30px);">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body py-4 px-5">
            <a href="/" class="text-decoration-none text-white position-absolute top-0 start-0 m-3"><h2><i class="bi bi-arrow-left-circle text-dark"></i></h2></a>
            <h2 class="fw-bold mb-5 mt-4">Sign In Now</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-floating mb-3 mx-auto" style="max-width: 700px">
                    <input type="email" class="form-control" name="email" placeholder="email" required>
                    <label>Email</label>
                </div>
                <div class="form-floating mb-3 mx-auto" style="max-width: 700px">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-2">Sign in</button>
                <p>Not registered yet? <a href="{{ route('register') }}">Register now!</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
