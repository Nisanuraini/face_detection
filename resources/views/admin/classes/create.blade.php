@extends('admin.home')

@section('content')
    <h1>Add New Class</h1>
    <form action="{{ route('classes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="class_name">Nama Kelas</label>
            <input type="text" name="class_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="student_id">Nama Siswa</label>
            <select name="student_id" class="form-control" required>
                <option value="">-- Select Student --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
