<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/Logo YPI.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style-home.css">
    <title>SiswaGo</title>
</head>
<body>
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home" id="home">
            <img src="images/backgroundhomesiswago.jpg" alt="" class="home__img">
            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Menjemput Siswa dengan cepat</span>
                    <h1 class="home__data-title">Hemat Waktumu<br> dengan <b> SiswaGo</b></h1>
                    <a href="{{ route('admin.home') }}" class="button">Mulai</a>
                </div>
            </div>
        </section>
    </main>

    <script src="js/scrollreveal.min.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>


{{-- 
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
@endsection --}}
