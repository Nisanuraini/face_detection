@extends('admin.home')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penjemputan</h1>

    <div class="mb-3">
        <strong>Nama Penjemput:</strong> {{ $pickup->pickup_name }}
    </div>
    
    <a href="{{ route('pickups.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
