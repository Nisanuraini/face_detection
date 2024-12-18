@extends('admin.home')

@section('content')
    <h1>Detail Siswa</h1>
    <p><strong>Nama Siswa:</strong> {{ $student->name }}</p>
    <p><strong>NIS:</strong> {{ $student->nis }}</p>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali ke Daftar Siswa</a>
@endsection
