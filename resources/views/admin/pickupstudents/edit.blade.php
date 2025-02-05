@extends('admin.home')

@section('content')
<div class="container mt-4">
    <h1>Edit Data Penjemputan</h1>
    <form action="{{ route('pickupstudents.update', $pickupStudent->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="student_id" class="form-label">Nama Siswa</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">Pilih Siswa</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $pickupStudent->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="pickup_nama" class="form-label">Nama Penjemput</label>
            <input type="text" name="pickup_nama" id="pickup_nama" class="form-control" value="{{ $pickupStudent->pickup_nama }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pickup_students.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
