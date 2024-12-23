@extends('admin.home')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penjemputan</h1>

    <div class="mb-3">
        <strong>Nama Siswa:</strong> {{ $pickup->student->name }}
    </div>

    <div class="mb-3">
        <strong>Nama Penjemput:</strong> {{ $pickup->pickup_name }}
    </div>

    <div class="mb-3">
        <strong>Gambar Penjemput:</strong> 
        @if ($pickup->pickup_image)
            <img src="{{ asset('storage/' . $pickup->pickup_image) }}" alt="Pickup Image" width="100">
        @endif
    </div>

    <div class="mb-3">
        <strong>Tanggal:</strong> {{ $pickup->date }}
    </div>

    <div class="mb-3">
        <strong>Jam:</strong> {{ $pickup->time }}
    </div>

    <a href="{{ route('pickups.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
