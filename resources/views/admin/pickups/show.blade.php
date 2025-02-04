@extends('admin.home')

@section('content')

<div class="container">
    <h1 class="mb-4">Detail Penjemputan</h1>

    <div class="mb-3">
        <strong>Nama Penjemput:</strong> {{ $pickup->pickup_name }}
    </div>

    <div class="card-body">
        @if($pickup->student) 
            <p><strong>Nama Siswa:</strong> {{ $pickup->student->name }}</p>
        @else
            <p>Tidak ada siswa yang ditemukan untuk penjemput ini.</p>
        @endif
    </div>

    <a href="{{ route('pickups.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@endsection
