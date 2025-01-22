@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Kelas</h1>
    <div class="p-4 border rounded shadow">
        <p><strong>Nama Kelas:</strong> {{ $classroom->class_name }}</p>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createStudentModal">Tambah Siswa</button>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classroom->students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}">Edit</button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline-block" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Siswa -->
                    <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editStudentModalLabel{{ $student->id }}">Edit Siswa</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('students.update', $student->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name{{ $student->id }}">Nama Siswa</label>
                                            <input type="text" class="form-control" id="name{{ $student->id }}" name="name" value="{{ $student->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nis{{ $student->id }}">NIS</label>
                                            <input type="text" class="form-control" id="nis{{ $student->id }}" name="nis" value="{{ $student->nis }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="classroom_id{{ $student->id }}">Kelas</label>
                                            <select name="classroom_id" class="form-control">
                                                <option value="{{ $classroom->id }}" selected>{{ $classroom->class_name }}</option>
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
        <div class="text-start mt-3">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<!-- Modal untuk tambah siswa -->
<div class="modal fade" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStudentModalLabel">Tambah Siswa ke Kelas</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Siswa</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" required>
                    </div>
                    <div class="form-group">
                        <label for="classroom_id">Kelas</label>
                        <select name="classroom_id" class="form-control">
                            <option value="{{ $classroom->id }}" selected>{{ $classroom->class_name }}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Siswa</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
