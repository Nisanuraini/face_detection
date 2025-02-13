@extends('layouts.main') <!-- Menggunakan template layout utama -->

@section('style')
    <style>
        .circle-dots {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 1px solid blue;
        }

        /* Styling untuk card */
        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk header */
        .dashboard-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4e73df;
        }

        .badge-status {
            font-weight: bold;
        }
    </style>
@endsection

@section('main-content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 dashboard-header">Dashboard Penjemputan Siswa</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Students -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Siswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalstudents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-fill fs-2 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pickups -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Penjemputan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalpickups }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-check-fill fs-2 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Drivers Available -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah kelas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalclasses }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-building-check fs-2 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card card-custom border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Sekolah
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalschools }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-buildings fs-2 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            {{-- ... --}}
   
  
            <!-- Today's Transaction (Booking) -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Penjemputan Hari ini (Pickups)</h6>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table id="basic-table" class="table mb-0 table-striped" role="grid">
                              <thead class="table-light">
                                  <tr>
                                      <th>Nama Siswa</th>
                                      <th>Nama Penjemput</th>
                                      <th>Gambar</th>
                                      <th>Tanggal</th>
                                      <th>Waktu</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse($recentListFaceDetection as $item)
                                  <tr>
                                      <td>{{ optional($item->student)->name }}</td>
                                      <td>{{ $item->pickup_name }}</td>
                                      <td>
                                          @if($item->pickup_image)
                                          <img src="{{ asset('storage/' . $item->pickup_image) }}" 
                                               alt="Gambar Penjemput" 
                                               class="img-thumbnail" 
                                               style="width: 80px; height: 80px; object-fit: cover;">
                                          @else
                                              <span class="text-muted">Tidak ada gambar</span>
                                          @endif
                                      </td>
                                      <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                      <td>{{ $item->time }}</td>
                                      <td>
                                          <a href="{{ route('pickups.show', $item->id) }}" class="btn btn-info btn-sm"><i class="bi bi-search"></i> Detail</a>
                                          </button>
                                      </td>
                                  </tr>
                                  @empty
                                  <tr>
                                      <td colspan="6" class="text-center text-muted">Belum ada data penjemputan.</td>
                                  </tr>
                                  @endforelse
                              </tbody>
                          </table>
                   </div>
              </div>
          </div>
        </div>
  
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Penjemput</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                      @forelse ($recentListFaceDetection as $item)
                      <td>{{ optional ($item->student)->name }}</td>
                      <td>{{ $item->pickup_name }}</td>
                      <td>
                          @if($item->pickup_image)
                          <img src="{{ asset('storage/' . $item->pickup_image) }}"
                               alt="Gambar Penjemput" 
                               class="img-thumbnail" 
                               style="width: 80px; height: 80px; object-fit: cover;">
                          @else
                              <span class="text-muted">Tidak ada gambar</span>
                          @endif
                      </td>
                      <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                      <td>{{ $item->time }}</td>
                      <td>
                          <a href="{{ route('pickups.show', $item->id) }}" class="btn btn-info btn-sm"><i class="bi bi-search"></i> Detail</a>
                          </button>
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="6" class="text-center text-muted">Belum ada data penjemputan.</td>
                  </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>

@endsection