@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Sekolah</h1>
    <a href="{{ route('schools.create') }}" class="btn btn-primary mb-3">Tambah Sekolah</a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        </script>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Total Kelas</th>
                    <th>Total Siswa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $school)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $school->total_classes }}</td> <!-- Ini yang benar -->
                        <td>{{ $school->total_students }}</td> <!-- Ini yang benar -->
                        <td>
                            <a href="{{ route('schools.show', $school) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('schools.edit', $school) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('schools.destroy', $school) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
