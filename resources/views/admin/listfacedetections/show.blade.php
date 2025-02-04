@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Penjemputan</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama Siswa:</strong> {{ optional($listFaceDetection->student)->name }}</p>
            <p><strong>Nama Penjemput:</strong> {{ $listFaceDetection->pickup_name }}</p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($listFaceDetection->date)->format('d-m-Y') }}</p>
            <p><strong>Waktu:</strong> {{ $listFaceDetection->time }}</p>
            @if($listFaceDetection->pickup_image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $listFaceDetection->pickup_image) }}" alt="Gambar Penjemput" class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
            </div>
            @else
                <span class="text-muted">Tidak ada gambar</span>
            @endif
        </div>
    </div>
    <a href="{{ route('listfacedetections.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Penjemputan</a>
</div>
@endsection