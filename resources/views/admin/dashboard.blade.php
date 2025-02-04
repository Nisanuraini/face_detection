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
        window.location.reload(); // Reload halaman untuk mengembalikan konten asli
    }
</script>

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
