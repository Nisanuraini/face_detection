@extends('admin.home')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Sekolah</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Sekolah</button>

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
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Sekolah</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead> 
        <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $school->name }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $school->id }}">Edit</button>
                        <a href="{{ route('schools.show', $school->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <form action="{{ route('schools.destroy', $school) }}" method="POST" class="d-inline-block" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sekolah ini?')">
                             @csrf
                             @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $school->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $school->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $school->id }}">Edit Sekolah</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('schools.update', $school->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Nama Sekolah</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $school->name }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('schools.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Sekolah</label>
                        <input type="text" class="form-control" id="school_name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Sekolah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
