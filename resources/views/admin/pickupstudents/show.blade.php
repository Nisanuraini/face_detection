@extends('admin.layouts.main')

@section('main-content')
<div class="container mt-4">
    <h1>Detail Penjemputan</h1>
    <table class="table table-bordered">
        <tr>
            <th>Nama Siswa</th>
            <td>{{ $pickupStudent->student->name }}</td>
        </tr>
        <tr>
            <th>Nama Penjemput</th>
            <td>{{ $pickupStudent->pickup_nama }}</td>
        </tr>
    </table>
    <a href="{{ route('pickup_students.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
