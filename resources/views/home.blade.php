@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-image: url('{{ asset('images/image.png') }}'); background-size: cover; height: 100vh; color: white;">
    <div class="row justify-content-center align-items-center" style="height: 100%;">
        <div class="col-md-8 text-center">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent text-white">
                    <h2><strong>{{ __('Penjemputan Siswa TK') }}</strong></h2>
                </div>

                <div class="card-body">
                    <p class="lead">{{ __('Selamat datang di aplikasi penjemputan siswa TK!') }}</p>
                    <p>{{ __('Di sini Anda dapat mengelola informasi penjemputan siswa, termasuk riwayat penjemputan.') }}</p>
                    
                    <!-- Tombol Mulai -->
                    <a href="{{ route('admin.home') }}" class="btn btn-primary mt-4">{{ __('Mulai') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
