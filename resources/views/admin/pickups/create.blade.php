@extends('admin.home')

@section('content')
<div class="container">
    <h1>Tambah Data Penjemputan</h1>
        <form action="{{ route('pickups.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">Nama Siswa</label>
            <select name="student_id" id="student_id" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pickup_name" class="form-label">Nama Penjemput</label>
            <input type="text" name="pickup_name" id="pickup_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="pickup_image" class="form-label">Gambar Penjemput</label>
            <input type="file" name="pickup_image" id="pickup_image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Jam</label>
            <input type="time" name="time" id="time" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
