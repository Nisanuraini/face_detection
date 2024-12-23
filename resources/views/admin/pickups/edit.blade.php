@extends('admin.home')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Penjemputan</h1>

    <form action="{{ route('pickups.update', $pickup->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="student_id" class="form-label">Nama Siswa</label>
            <select name="student_id" id="student_id" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $pickup->student_id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pickup_name" class="form-label">Nama Penjemput</label>
            <input type="text" name="pickup_name" id="pickup_name" class="form-control" value="{{ $pickup->pickup_name }}">
        </div>

        <div class="mb-3">
            <label for="pickup_image" class="form-label">Gambar Penjemput</label>
            <input type="file" name="pickup_image" id="pickup_image" class="form-control">
            @if ($pickup->pickup_image)
                <img src="{{ asset('storage/' . $pickup->pickup_image) }}" alt="Pickup Image" width="50">
            @endif
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $pickup->date }}">
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Jam</label>
            <input type="time" name="time" id="time" class="form-control" value="{{ $pickup->time }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
