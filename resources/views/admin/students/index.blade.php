@extends('admin.home')

@section('content')
    <h1>Daftar Siswa</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Siswa</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
