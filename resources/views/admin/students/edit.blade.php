@extends('admin.home')

@section('content')
    <h1>Edit Siswa</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Siswa</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}" required>
        </div>
        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" name="nis" id="nis" class="form-control" value="{{ $student->nis }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
@endsection
