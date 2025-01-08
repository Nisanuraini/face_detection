@extends('admin.home')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Penjemputan Siswa</h1>
    <a href="{{ route('pickups.create') }}" class="btn btn-primary mb-3">Tambah Penjemputan</a>

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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Nama Penjemput</th>
                <th>Gambar</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pickups as $pickup)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pickup->student->name }}</td>
                    <td>{{ $pickup->pickup_name }}</td>
                    <td>     
                        <a href="{{ asset('storage/' . $pickup->pickup_image) }}" target="_blank">
                            <img src="{{ url('storage/' . $pickup->pickup_image) }}" alt="Pickup_Image" width="100" class="img-thumbnail">
                        </a>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($pickup->date)->format('d-m-Y') }}</td>
                    <td>{{ $pickup->time }}</td>
                    <td>
                        <a href="{{ route('pickups.show', $pickup->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('pickups.edit', $pickup->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pickups.destroy', $pickup->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
