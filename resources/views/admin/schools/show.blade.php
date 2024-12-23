@extends('admin.home')

@section('content')
    <h1>Detail Sekolah</h1>

    <p>Nama Sekolah: {{ $school->name }}</p>
    <p>Siswa: {{ $school->student->name }}</p>
    <p>Kelas: {{ $school->classroom->class_name }}</p>

    <a href="{{ route('schools.index') }}" class="btn btn-primary">Kembali</a>
@endsection
