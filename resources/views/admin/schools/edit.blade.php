@extends('admin.home')

@section('content')
    <h1>Edit Sekolah</h1>

    <form action="{{ route('schools.update', $school->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Sekolah:</label>
            <input type="text" name="name" value="{{ $school->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Siswa:</label>
            <select name="student_id" class="form-control">
                @foreach($students as $student)
                <option value="{{ $student->id }}" {{ $student->id == $school->student_id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Kelas:</label>
            <select name="class_id" class="form-control">
                @foreach($classes as $classroom)
                <option value="{{ $classroom->id }}" {{ $classroom->id == $school->class_id ? 'selected' : '' }}>{{ $classroom->class_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection