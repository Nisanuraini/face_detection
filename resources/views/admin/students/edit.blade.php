@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Siswa</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST" 
          onsubmit="return confirm('Apakah Anda yakin ingin mengupdate data siswa ini?')">
        @csrf
        @method('PUT')
        <div class="form-group mb-4">
            <label for="name">Nama Siswa</label>
            <input type="text" name="name" class="form-control rounded-pill" value="{{ old('name', $student->name) }}" required>
        </div>
        <div class="form-group mb-4">
            <label for="nis">NIS</label>
            <input type="text" name="nis" id="nis" class="form-control rounded-pill" 
            value="{{ old('nis', $student->nis) }}" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">Update</button>
        </div>
    </form>
</div>
@endsection
