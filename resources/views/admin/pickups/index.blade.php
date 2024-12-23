@extends('admin.home')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Penjemputan Siswa</h1>
    <a href="{{ route('pickups.create') }}" class="btn btn-primary mb-3">Tambah Penjemputan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Nama Penjemput</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pickups as $pickup)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pickup->student->name }}</td>
                    <td>{{ $pickup->pickup_name }}</td>
                    <td>{{ $pickup->date }}</td>
                    <td>{{ $pickup->time }}</td>
                    <td>
                        @if ($pickup->pickup_image)
                            <img src="{{ asset('storage/' . $pickup->pickup_image) }}" alt="Pickup Image" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pickups.show', $pickup->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('pickups.edit', $pickup->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pickups.destroy', $pickup->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
