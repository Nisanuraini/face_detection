@extends('admin.home')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Penjemput</h1>

    <div class="card-header">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td><p><strong>Nama Penjemput:</strong> {{ $pickup->pickup_name }}</p></td>
                </tr>
                <tr>
                <td><p><strong>Nama Siswa:</strong> {{ $pickup->student->name }}</p></td>
                </tr>
            </table>
            <a href="{{ route('pickups.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
