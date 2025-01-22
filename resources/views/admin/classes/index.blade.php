@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Kelas</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Kelas</button>

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
                    <th>Nama Sekolah</th>
                    <th>Nama Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $classroom)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $classroom->class_name }}</td>
                        <td>{{ $classroom->school ? $classroom->school->name : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('classes.show', $classroom->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $classroom->id }}">Edit</button>
                            <form action="{{ route('classes.destroy', $classroom) }}" method="POST" class="d-inline-block" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $classroom->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $classroom->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $classroom->id }}">Edit Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('classes.update', $classroom->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="pickup_name">Nama Kelas</label>
                                        <input type="text" class="form-control" id="class_name" name="class_name" value="{{ $classroom->class_name }}" required>
                                    </div>
                                </div> 
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="school_id">Sekolah</label>
                                        <select class="form-control" id="school_id" name="school_id" required>
                                            <option value="">Pilih Sekolah</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                                            @endforeach
                                        </select>
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

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('classes.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="class_name">Nama Kelas</label>
                        <input type="text" class="form-control" id="class_name" name="class_name" required>
                    </div>
                </div>     
                <div class="modal-body">
                    <div class="form-group">
                        <label for="classroom_id">Sekolah</label>
                        <select class="form-control" id="school_id" name="school_id" required>
                            <option value="">Pilih Sekolah</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>                                      
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    });
</script>

@endsection
