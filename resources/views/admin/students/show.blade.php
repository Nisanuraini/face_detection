@extends('admin.home')

@section('content')
    <h1>Detail Siswa</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama Siswa:</strong> {{ $student->name }}</p>
            <p><strong>NIS:</strong> {{ $student->nis }}</p>
        </div>
    </div>
    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Siswa</a>
@endsection