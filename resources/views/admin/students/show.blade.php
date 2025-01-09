@extends('admin.home')

@section('content')
    <h1>Detail Siswa</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- Menampilkan gambar siswa -->
                    <img src="{{ $student->photo_url }}" alt="Foto {{ $student->name }}" class="img-fluid rounded mb-3">
                </div>
                <div class="col-md-8">
                    <!-- Menampilkan nama dan NIS siswa -->
                    <p><strong>Nama Siswa:</strong> {{ $student->name }}</p>
                    <p><strong>NIS:</strong> {{ $student->nis }}</p>
                </div>
            </div>
            <!-- Tabel untuk informasi tambahan -->
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Informasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $student->address }}</td>
                    </tr>
                    <tr>
                        <td>Nama Orang Tua</td>
                        <td>{{ $student->parent_name }}</td>
                    </tr>
                    <tr>
                        <td>Kontak Orang Tua</td>
                        <td>{{ $student->parent_contact }}</td>
                    </tr>
                    <tr>
                        <td>Kontak Darurat</td>
                        <td>{{ $student->emergency_contact }}</td>
                    </tr>
                    <tr>
                        <td>Nama Penjemput</td>
                        <td>{{ $student->pickup_person }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Siswa</a>
@endsection
