@extends('admin.home')

@section('content')
<div class="container mt-4">
    <h1>Daftar Penjemputan</h1>
    <a href="{{ route('pickupstudents.create') }}" class="btn btn-primary mb-3">Tambah Data Penjemputan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Nama Penjemput</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pickups as $pickup)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pickup->student->name }}</td>
                    <td>{{ $pickup->pickup_nama }}</td>
                    <td>
                        <a href="{{ route('pickupstudents.show', $pickup->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('pickupstudents.edit', $pickup->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pickupstudents.destroy', $pickup->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
