@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

@endsection
 
@section('main-content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Siswa</h1>
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">
      Tambah Siswa
    </button>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th><center>Nama</center></th>
                          <th><center>Nis</center></th>
                          <th><center>Kelas</center></th>
                          <th><center>Aksi</center></th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->classroom->class_name }}</td>
                        <td class="d-flex flex-row align-items-start gap-1">
                          <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $student->id }}">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <form action="{{ route('students.destroy', $student->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini?');"><i class="bi bi-x-circle"></i></button>
                          </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $student->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <form action="{{ route('classes.update', $student) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div class="mb-3">
                                <label for="class_name" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" id="class_name" name="class_name" value="{{ $student->class_name }}" required>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Edit</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  @if(session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
  @endif

  @if($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

</div>
@endsection

@section('script')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
      $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['pdf', 'excel', 'print']
      });
    </script>
@endsection

<!-- Modal Create -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Nama <small>(Nama Lengkap)</small></label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="nis" class="form-label">Nis </label>
            <input type="text" class="form-control" id="nis" name="nis" required>
          </div>
          <div class="mb-3">
            <label for="class_id" class="form-label">Kelas</label>
            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror">
                @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                 @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="student_image" class="form-label">Foto Siswa  <small>(maksimal 1MB)</small></label>
            <input class="form-control" type="file" id="student_image" name="student_image">
          </div>      
          <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>
          <div class="mb-3">
            <label for="parent_name" class="form-label">Nama Orang Tua</label>
            <input type="text" class="form-control" id="parent_name" name="parent_name" required>
          </div>
          <div class="mb-3">
            <label for="parent_contact" class="form-label">Kontak Orang Tua</label>
            <input type="text" class="form-control" id="parent_contact" name="parent_contact" required>
          </div>
          <div class="mb-3">
            <label for="emergency_contact" class="form-label">Kontak Darurat</label>
            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" required>
          </div>
          <div class="mb-3">
            <label for="pickup_person" class="form-label">Penjemput</label>
            <input type="text" class="form-control" id="pickup_person" name="pickup_person" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </div>
    </form>
    </div>
</div>