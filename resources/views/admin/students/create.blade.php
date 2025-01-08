@extends('admin.home')

@section('content')

<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-4">
            <h2 class="mb-0" style="color: black;">Tambah Siswa</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Nama Siswa</label>
                    <input type="text" name="name" id="name" class="form-control rounded-pill px-4" value="{{ old('name') }}" required>
                </div>
                <div class="mb-4">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" name="nis" id="nis" class="form-control rounded-pill px-4" value="{{ old('nis') }}" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">Simpan</button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary btn-lg rounded-pill px-5 ms-3">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
