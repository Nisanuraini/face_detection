@extends('admin.home')

@section('page_title', 'Dashboard Penjemputan')

@section('content')
<div class="container mt-4">
    <!-- Row for Statistics Cards -->
    <div class="row">
        <!-- Card 1: Total Siswa -->
        <div class="col-md-4">
            <div class="card border-primary mb-3 shadow-sm">
                <div class="card-header bg-primary text-white text-center">Total Siswa</div>
                <div class="card-body text-center">
                    <h3 class="text-primary m-0">{{ $totalStudents ?? '0' }}</h3>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Penjemputan -->
        <div class="col-md-4">
            <div class="card border-success mb-3 shadow-sm">
                <div class="card-header bg-success text-white text-center">Total Penjemputan</div>
                <div class="card-body text-center">
                    <h3 class="text-success m-0">{{ $totalPickups ?? '0' }}</h3>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Kelas -->
        <div class="col-md-4">
            <div class="card border-danger mb-3 shadow-sm">
                <div class="card-header bg-danger text-white text-center">Total Kelas</div>
                <div class="card-body text-center">
                    <h3 class="text-danger m-0">{{ $totalClasses ?? '0' }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Penjemputan -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <span>Riwayat Penjemputan Terkini</span>
                    <div class="search-box d-flex">
                        <label for="search" class="d-none">Search</label>
                        <input type="text" id="search" class="form-control form-control-sm" placeholder="Cari Riwayat...">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
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
                                    <td>{{ $pickup->student_name ?? 'N/A' }}</td>
                                    <td>{{ $pickup->date ?? 'N/A' }}</td>
                                    <td>{{ $pickup->time ?? 'N/A' }}</td>
                                    <td>{{ $pickup->pickup_name ?? 'N/A' }}</td>
                                    <td>
                                        @if(!empty($pickup->image))
                                            <img src="{{ asset('storage/' . $pickup->image) }}" alt="Gambar Penjemput" class="rounded img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info">Detail</button>
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
    </div>

    <!-- Additional Row or Section (Optional) -->
    <div class="row mt-4">
        <div class="col-md-12">
            <!-- You can add other statistics, charts, or information here -->
        </div>
    </div>

</div>
@endsection
