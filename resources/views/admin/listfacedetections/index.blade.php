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
                    <th>Nama Siswa</th>
                    <th>Nama Penjemput</th>
                    <th>Gambar</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listFaceDetections as $item)
                <tr>
                    <td>{{ optional($item->student)->name }}</td>
                    <td>{{ $item->pickup_name }}</td>
                    <td>
                        @if($item->pickup_image)
                        <img src="{{ asset('storage/' . $item->pickup_image) }}" 
                             alt="Gambar Penjemput" 
                             class="img-thumbnail" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                    <td>{{ $item->time }}</td>
                    <td>
                        <a href="{{ route('listfacedetections.show', $item->id) }}" class="btn btn-info btn-sm"><i class="bi bi-search"></i> Detail</a>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"><i class="bi bi-pencil"></i> Edit</button>
                        <form action="{{ route('listfacedetections.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Penjemputan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('listfacedetections.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="student_id" class="form-label">Nama Siswa</label>
                                        <select name="student_id" id="student_id" class="form-control" required>
                                            @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ $student->id == $item->student_id ? 'selected' : '' }}>{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pickup_name" class="form-label">Nama Penjemput</label>
                                        <input type="text" name="pickup_name" id="pickup_name" class="form-control" value="{{ $item->pickup_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pickup_image" class="form-label">Gambar Penjemput</label>
                                        @if($item->pickup_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $item->pickup_image) }}" alt="Gambar Penjemput" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>
                                        @endif
                                        <input type="file" name="pickup_image" id="pickup_image" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Tanggal</label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ $item->date }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Waktu</label>
                                        <input type="time" name="time" id="time" class="form-control" value="{{ $item->time }}" required>
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
                <form action="{{ route('listfacedetections.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="mb-3">
                        <label for="pickup_image" class="form-label">Gambar Penjemput</label>
                        <input type="file" name="pickup_image" id="pickup_image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Waktu</label>
                        <input type="time" name="time" id="time" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection