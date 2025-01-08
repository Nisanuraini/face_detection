@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Kelas</h1>

    <form action="{{ route('classes.update', $classroom) }}" method="POST" 
          onsubmit="return confirm('Apakah Anda yakin ingin mengupdate data kelas ini?')">
        @csrf
        @method('PUT')
        <div class="form-group mb-4">
            <label for="class_name">Nama Kelas</label>
            <input type="text" name="class_name" class="form-control rounded-pill" value="{{ old('class_name', $classroom->class_name) }}" required>
        </div>
        <div class="form-group mb-4">
            <label for="student_id">Siswa</label>
            <select name="student_id" class="form-select rounded-pill" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $classroom->student_id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">Update</button>
        </div>
    </form>
</div>
@endsection
