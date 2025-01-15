@extends('admin.home')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Detail Siswa</h1>
        <div class="row mb-4">
            <div class="col-md-3 text-center">
                @if($student->student_image)
                <img src="{{ asset('storage/students/' . $student->student_image) }}" alt="Student Image" width="100">
                @endif
            </div>
            <div class="col-md-9">
                <h3 class="text-primary">{{ $student->name }}</h3>
                <p><strong>NIS:</strong> {{ $student->nis }}</p>
                <p><strong>Kelas:</strong> {{ $student->classroom->name ?? 'Belum Ditetapkan' }}</p>
            </div>
        </div> 
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Lengkap</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $student->address ?? 'Tidak ada alamat' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Orang Tua</th>
                            <td>{{ $student->parent_name ?? 'Tidak ada data' }}</td>
                        </tr>
                        <tr>
                            <th>Kontak Orang Tua</th>
                            <td>{{ $student->parent_contact ?? 'Tidak ada data' }}</td>
                        </tr>
                        <tr>
                            <th>Kontak Darurat</th>
                            <td>{{ $student->emergency_contact ?? 'Tidak ada data' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Penjemput</th>
                            <td>{{ $student->pickup_person ?? 'Tidak ada data' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
