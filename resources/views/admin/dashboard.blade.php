<!-- filepath: /C:/penjemputan/resources/views/admin/dashboard.blade.php -->
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
            <div class="d-flex">
                <form action="#" method="GET" class="d-flex me-2">
                    <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari siswa atau penjemput">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </form>
                <button class="btn btn-sm btn-secondary" onclick="printTable()">
                    <i class="bi bi-printer"></i> Cetak Laporan
                </button>
            </div>
        </div>
        <div class="card-body">
            <div id="printableTable" class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Nama Penjemput</th>
                            <th>Gambar</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentListFaceDetection as $item)
                        <tr>
                            <td>{{ optional($item->student)->name }}</td>
                            <td>{{ $item->pickup_name }}</td>
                            <td>
                                @if($item->pickup_image)
                                <img src="{{ asset('storage/' . $item->pickup_image) }}" 
                                     alt="Gambar Penjemput" 
                                     class="img-thumbnail" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                            <td>{{ $item->time }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data penjemputan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function printTable() {
        var printContent = document.getElementById('printableTable').innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = `
            <html>
            <head>
                <title>Cetak Laporan</title>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    table, th, td {
                        border: 1px solid black;
                    }
                    th, td {
                        padding: 8px;
                        text-align: center;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>
            </head>
            <body>
                <h3>Riwayat Penjemputan</h3>
                ${printContent}
            </body>
            </html>
        `;

        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload(); 
    }
</script>

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection