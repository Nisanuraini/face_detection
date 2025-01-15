@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Kelas</h1>
    <a href="{{ route('classes.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $classroom)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $classroom->class_name }}</td>
                        <td>
                            <a href="{{ route('classes.show', $classroom) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('classes.edit', $classroom) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('classes.destroy', $classroom) }}" method="POST" class="d-inline-block" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?')">
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

<script>
    // Cek apakah ada alert dan tutup setelah 3 detik
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    });
</script>
@endsection
