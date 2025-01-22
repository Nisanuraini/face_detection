@extends('admin.home')

@section('content')
<div class="container mt-4">
    <h1>Tambah Data Penjemputan</h1>
    <form action="{{ route('pickupstudents.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="student_id" class="form-label">Nama Siswa</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">Pilih Siswa</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="pickup_nama" class="form-label">Nama Penjemput</label>
            <input type="text" name="pickup_nama" id="pickup_nama" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pickupstudents.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
