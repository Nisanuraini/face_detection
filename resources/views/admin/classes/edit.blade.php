@extends('admin.home')

@section('content')
    <h1>Edit Class</h1>
    <form action="{{ route('classes.update', $class) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="class_name">Name kelas</label>
            <input type="text" name="class_name" class="form-control" value="{{ $class->class_name }}" required>
        </div>
        <div class="mb-3">
            <label for="student_id">Nama Siswa</label>
            <select name="student_id" class="form-control" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $class->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
