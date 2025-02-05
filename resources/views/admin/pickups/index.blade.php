@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Penjemputan</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Penjemputan</button>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Penjemput</th>
                    <th>Nama Siswa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pickups as $pickup)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pickup->pickup_name }}</td>
                    <td>{{ $pickup->student->name }}</td>
                    <td>
                        <a href="{{ route('pickups.show', $pickup->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $pickup->id }}">Edit</button>
                        <form action="{{ route('pickups.destroy', $pickup) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus penjemputan?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $pickup->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pickup->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $pickup->id }}">Edit Penjemputan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pickups.update', $pickup->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="student_id" class="form-label">Nama Siswa</label>
                                        <select name="student_id" id="student_id" class="form-control" required>
                                            @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ $student->id == $pickup->student_id ? 'selected' : '' }}>{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pickup_name" class="form-label">Nama Penjemput</label>
                                        <input type="text" name="pickup_name" id="pickup_name" class="form-control" value="{{ $pickup->pickup_name }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Penjemputan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pickups.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Nama Siswa</label>
                        <select name="student_id" id="student_id" class="form-control" required>
                            @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pickup_name" class="form-label">Nama Penjemput</label>
                        <input type="text" name="pickup_name" id="pickup_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection