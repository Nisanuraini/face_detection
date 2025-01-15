@extends('admin.home')

@section('content')
    <div class="container">
        <h1>Tambah Siswa</h1>
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" value="{{ old('nis') }}" required>
            </div>

            <div class="form-group">
                <label>Kelas:</label>
                <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}s</option>
                     @endforeach
                </select>
                @error('class_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
          
            <div class="form-group">
                <label for="student_image">Foto Siswa</label>
                <input type="file" name="student_image" id="student_image" class="form-control">
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="parent_name">Nama Orang Tua</label>
                <input type="text" name="parent_name" id="parent_name" class="form-control" value="{{ old('parent_name') }}">
            </div>

            <div class="form-group">
                <label for="parent_contact">Kontak Orang Tua</label>
                <input type="text" name="parent_contact" id="parent_contact" class="form-control" value="{{ old('parent_contact') }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact">Kontak Darurat</label>
                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}">
            </div>

            <div class="form-group">
                <label for="pickup_person">Penjemput</label>
                <input type="text" name="pickup_person" id="pickup_person" class="form-control" value="{{ old('pickup_person') }}">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
