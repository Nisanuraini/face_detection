@extends('admin.home')

@section('content')
    <div class="container">
        <h1>Daftar Siswa</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->class->name ?? 'Belum Ditetapkan' }}</td>
                        <td>
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
