@extends('admin.home')

@section('content')
<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-4">
            <h2 class="mb-0">Tambah Kelas</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('classes.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="class_name" class="form-label">Nama Kelas</label>
                    <input type="text" name="class_name" id="class_name" class="form-control rounded-pill px-4" value="{{ old('class_name') }}" required>
                </div>
                <div class="mb-4">
                    <label for="student_id" class="form-label">Pilih Siswa</label>
                    <select name="student_id" id="student_id" class="form-select rounded-pill px-4" required>
                        <option value="" disabled selected>-- Pilih Siswa --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">Simpan</button>
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary btn-lg rounded-pill px-5 ms-3">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
