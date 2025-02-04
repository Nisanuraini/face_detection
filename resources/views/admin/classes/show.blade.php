@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Kelas</h1>
    <div class="p-4 border rounded shadow">
        <p><strong>Nama Kelas:</strong> {{ $classroom->class_name }}</p>
        <p><strong>Sekolah:</strong> {{ $classroom->school->name }}</p>
        
        <h2 class="mt-4">Daftar Siswa</h2>

        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Siswa</button>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classroom->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $student->id }}">Edit</button>

                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Siswa -->
                <div class="modal fade" id="editModal{{ $student->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $student->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $student->id }}">Edit Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('students.update', $student->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Siswa</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nis" class="form-label">NIS</label>
                                        <input type="text" class="form-control" id="nis" name="nis" value="{{ $student->nis }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol Print -->
        <a href="#" class="btn btn-success float-end">
            <i class="bi bi-printer"></i> Print</a>
        <script>
            document.querySelector('.btn-success.float-end').addEventListener('click', function() {
            var printContents = document.querySelector('.container').innerHTML;
            var originalContents = document.body.innerHTML;

            // Remove buttons and action column from print view
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = printContents;
            tempDiv.querySelectorAll('button, .btn, form').forEach(function(element) {
                element.remove();
            });
            tempDiv.querySelectorAll('th:last-child, td:last-child').forEach(function(element) {
                element.remove();
            });

            document.body.innerHTML = tempDiv.innerHTML;

            window.print();

            document.body.innerHTML = originalContents;
            window.location.reload();
            });
        </script>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<!-- Modal Create Siswa -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" required>
                    </div>
                    <input type="hidden" name="class_id" value="{{ $classroom->id }}">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
