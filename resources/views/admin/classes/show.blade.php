@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Kelas</h1>
    <div class="p-4 border rounded shadow">
        <p><strong>Nama Kelas:</strong> {{ $classroom->class_name }}</p>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
