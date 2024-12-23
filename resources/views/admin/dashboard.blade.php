@extends('admin.home')

@section('page_title', 'Dashboard Penjemputan')

@section('content')
<div class="container-fluid">
    <!-- Statistik Utama -->
    <div class="row g-3 mb-4">
        <!-- Total Siswa -->
        <div class="col-md-4">
            <div class="card bg-gradient-primary text-white shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="bi bi-people-fill"></i> Total Siswa
                    </h5>
                    <h2 class="display-4 fw-bold">{{ $totalStudents }}</h2>
                </div>
            </div>
        </div>
        <!-- Total Penjemput -->
        <div class="col-md-4">
            <div class="card bg-gradient-info text-white shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="bi bi-car-front-fill"></i> Total Penjemput
                    </h5>
                    <h2 class="display-4 fw-bold">{{ $totalPickups }}</h2>
                </div>
            </div>
        </div>
        <!-- Total Kelas -->
        <div class="col-md-4">
            <div class="card bg-gradient-success text-white shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <i class="bi bi-building"></i> Total Kelas
                    </h5>
                    <h2 class="display-4 fw-bold">{{ $totalClasses }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Penjemputan -->
    <div class="card shadow border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-clock-history"></i> Riwayat Penjemputan Terkini
            </h5>
            <a href="#" class="btn btn-sm btn-primary">
                <i class="bi bi-eye"></i> Lihat Semua
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Nama Penjemput</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPickups as $pickup)
                        <tr>
                            <td>{{ optional($pickup->student)->name }}</td>
                            <td>{{ $pickup->date }}</td>
                            <td>{{ $pickup->time }}</td>
                            <td>{{ $pickup->pickup_name }}</td>
                            <td>
                                @if($pickup->pickup_image)
                                    <img src="{{ asset('storage/' . $pickup->pickup_image) }}" 
                                         alt="Gambar Penjemput" 
                                         class="img-thumbnail" 
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info">
                                    <i class="bi bi-search"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data penjemputan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</style>
@endsection
