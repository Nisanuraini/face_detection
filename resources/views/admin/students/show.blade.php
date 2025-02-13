@extends('admin.layouts.main')

@section('main-content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Detail Siswa</h1>
    <div class="p-4 border rounded shadow">
        <div class="text-end mb-3">
            <button onclick="printStudentDetails()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>

        <script>
            function printStudentDetails() {
                var printContents = document.querySelector('.p-4').cloneNode(true);
                var printButton = printContents.querySelector('.text-end');
                printButton.remove();
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents.innerHTML;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center" style="width: auto; margin: 0 auto;">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 30%;">Foto Siswa</th>
                        <th style="width: 70%;">Informasi Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            @if($student->photo)
                                <a href="{{ asset('storage/' . $student->photo) }}" target="_blank">
                                    <img src="{{ url('storage/' . $student->photo) }}" 
                                    alt="Foto Siswa" class="img-fluid shadow-sm"
                                    style="width: 200px; height: 200px; object-fit: cover; border-radius: 8px;">    
                                </a>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center shadow-sm" 
                                     style="width: 200px; height: 200px; border-radius: 8px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                        </td>
                        <td class="text-start">
                            <p><strong>Nama Siswa:</strong> {{ $student->name }}</p>
                            <p><strong>NIS:</strong> {{ $student->nis }}</p>
                            <p><strong>Nama Kelas:</strong> {{ $student->classroom->class_name }}</p>
                            <p><strong>Nama Sekolah:</strong> {{ $student->school->name }}</p>
                            <p><strong>Alamat:</strong> {{ $student->address }}</p>
                            <p><strong>Nama Ibu:</strong> {{ $student->nama_ibu }}</p>
                            <p><strong>Nama Ayah:</strong> {{ $student->nama_ayah }}</p>
                            <p><strong>Kontak Orang Tua:</strong> {{ $student->parent_contact }}</p>
                            <p><strong>Kontak Darurat:</strong> {{ $student->emergency_contact }}</p>
                            <p><strong>Nama Penjemput:</strong> {{ $student->pickup_name }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-start mt-3">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection