@extends('admin.home')

@section('content')


<!--filter -->
<div class="container">
    <h1>Face Detection</h1>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="classDropdown" class="form-label">Pilih Kelas</label>
            <select id="classDropdown" class="form-select">
                <option value="">-- Pilih Kelas --</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="studentDropdown" class="form-label">Pilih Siswa</label>
            <select id="studentDropdown" class="form-select">
                <option value="">-- Pilih Siswa --</option>
            </select>
        </div>
    </div>


<!-- Scan Kamera Section -->
    <div class="text-center">
        <h2>Scan Kamera</h2>
        <div class="camera-wrapper mt-4">
            <video id="camera" autoplay playsinline class="camera-view"></video>
        </div>
        <div class="mt-3">
            <button id="openCamera" class="btn btn-primary">Buka Kamera</button>
            <button id="submitScan" class="btn btn-success">Submit</button>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Ambil data untuk dropdown
        $.ajax({
            url: '{{ route('face-detection-data') }}',
            method: 'GET',
            success: function(data) {
                // Isi dropdown kelas
                $.each(data.classes, function(index, item) {
                    $('#classDropdown').append('<option value="' + item.id + '">' + item.class_name + '</option>');
                });


                // Isi dropdown siswa
                $.each(data.students, function(index, item) {
                    $('#studentDropdown').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            },
            error: function() {
                alert('Gagal mengambil data');
            }
        });


        // Akses kamera
        $('#openCamera').click(function () {
            navigator.mediaDevices.enumerateDevices().then(function (devices) {
                const videoInputDevices = devices.filter(device => device.kind === 'videoinput');
                if (videoInputDevices.length > 0) {
                    // Pilih kamera bawaan (Integrated Camera)
                    const selectedDeviceId = videoInputDevices[0].deviceId;


                    navigator.mediaDevices.getUserMedia({
                        video: true
                    }).then(function (stream) {
                        const video = document.getElementById('camera');
                        video.srcObject = stream;
                        video.play();
                    }).catch(function (err) {
                        console.error('Gagal mengakses kamera:', err.message);
                        alert('Gagal mengakses kamera: ' + err.name + ' - ' + err.message);
                    });
                } else {
                    alert('Tidak ada perangkat kamera yang tersedia.');
                }
            }).catch(function (err) {
                console.error('Error mendapatkan perangkat:', err.message);
                alert('Error mendapatkan perangkat: ' + err.message);
            });
        });




        // Submit deteksi wajah
        $('#submitScan').click(function () {
            // Tambahkan logika submit di sini
            alert('Face detection berhasil dikirim!');
        });
    });
</script>


<style>
    .camera-wrapper {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        border: 2px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }


    .camera-view {
        width: 100%;
        height: auto;
        background-color: #000;
    }


    .btn {
        margin: 10px;
    }
</style>
@endsection