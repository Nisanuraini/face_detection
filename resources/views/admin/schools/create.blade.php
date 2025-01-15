@extends('admin.home')

@section('content')
    <h1>Tambah Sekolah</h1>

    <form action="{{ route('schools.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Total Kelas:</label>
            <input type="text" name="name" class="form-control @error('total kelas') is-invalid @enderror">
            @error('total kelas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Total Siswa:</label>
            <input type="text" name="name" class="form-control @error('total_classes') is-invalid @enderror">
            @error('total_classes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection