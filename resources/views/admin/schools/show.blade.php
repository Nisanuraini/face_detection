@extends('admin.home')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $school->name }}</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h2>Daftar Kelas dan Siswa</h2>
            </div>
            <div class="card-body">
                @if($school->classes->isEmpty())
                    <p>Tidak ada kelas yang ditemukan untuk sekolah ini.</p>
                @else
                    @foreach($school->classes as $classroom)
                        <div class="mt-4">
                            <h3>{{ $classroom->class_name }}</h3>
                            @if($classroom->students->isEmpty())
                                <p>Tidak ada siswa yang ditemukan untuk kelas ini.</p>
                            @else
                                <table class="table table-bordered table-striped text-center mt-3">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>NIS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classroom->students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->nis }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    @endforeach
                    <div class="text-start mt-3">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
