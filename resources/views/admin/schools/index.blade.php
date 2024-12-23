@extends('admin.home')

@section('content')
    <h1>Data Sekolah</h1>
    <a href="{{ route('schools.create') }}" class="btn btn-primary">Tambah Sekolah</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Sekolah</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schools as $school)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $school->name }}</td>
                <td>{{ $school->student->name }}</td>
                <td>{{ $school->classroom?->class_name ?? 'Tidak ada kelas' }}</td>
                <td>
                    <a href="{{ route('schools.show', $school->id) }}" class="btn btn-info">Lihat</a>
                    <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('schools.destroy', $school->id) }}" method="post" style="display:inline">
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