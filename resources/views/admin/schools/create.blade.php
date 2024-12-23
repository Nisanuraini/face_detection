@extends('admin.home')

@section('content')
    <h1>Tambah Sekolah</h1>

    <form action="{{ route('schools.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Nama Sekolah:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Siswa:</label>
            <select name="student_id" class="form-control @error('student_id') is-invalid @enderror">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            @error('student_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kelas:</label>
            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                @foreach($classes as $classroom)
                <option value="{{ $classroom->id }}">{{ $classroom->class_name }}s</option>
                 @endforeach
            </select>
            @error('class_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection