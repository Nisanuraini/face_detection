@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Penjemput</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Penjemput</button>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        });
    </script>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="thead-dark">
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
                            <form action="{{ route('pickups.destroy', $pickup->id) }}" method="POST" class="d-inline-block" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penjemput ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $pickup->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pickup->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('pickups.update', $pickup->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $pickup->id }}">Edit Penjemput</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-4">
                                            <label for="pickup_name">Nama Penjemput</label>
                                            <input type="text" name="pickup_name" class="form-control" value="{{ old('pickup_name', $pickup->pickup_name) }}" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="student_id">Siswa</label>
                                            <select name="student_id" class="form-control" required>
                                                @foreach($students as $student)
                                                    <option value="{{ $student->id }}" {{ $pickup->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pickups.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Penjemput</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="pickup_name">Nama Penjemput</label>
                        <input type="text" name="pickup_name" id="pickup_name" class="form-control" value="{{ old('pickup_name') }}" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="student_id">Siswa</label>
                        <select name="student_id" id="student_id" class="form-control" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
