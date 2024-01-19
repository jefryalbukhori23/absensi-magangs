<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Absensi | Foto Absensi</title>
    <link rel="icon" href="{{asset('assets/image/ds.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100dvh;
            width: 100%;
            overflow: hidden;
            position: relative;
            background: black;
        }
        .video {
            width: 100%;
            height: 100%;
        }
        .button-custom {
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            bottom: 50px;
            padding: 10px 20px;
            outline: none;
            border: 1px solid #000;
            border-radius: 20px;
            background-color: white;
            font-size: 20px;
        }

        .fullscreen-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .loading-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="fullscreen-overlay" style="display: none;">
        <div class="loading-container">
            <img src="{{ asset('assets/image/puff.svg') }}" class="me-4" style="width: 3rem"
                alt="audio">
            Loading...
        </div>
    </div>
    <video id="video" autoplay class="video" style="transform: scaleX(-1);"></video>
    <button id="captureBtn" style="cursor: pointer" class="button-custom"><i class="fas fa-camera"></i></button>
    <input type="hidden" id="id_student" value="{{ $student->id }}">
    <input type="hidden" id="kode" value="{{ $kode }}">
    <!-- <img id="capturedImage" style="display: none;"> -->
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // JavaScript code for camera access and capturing
        $(document).ready(function() {
            const video = document.getElementById('video');
            const captureBtn = document.getElementById('captureBtn');
            const capturedImage = document.getElementById('capturedImage');
            const locationInfo = document.getElementById('locationInfo');

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((error) => {
                    console.error('Error accessing camera: ', error);
                    // alert(error)
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengakses Kamera!',
                        text: 'Coba Untuk Refresh Halaman!',
                        // timer: 900
                    });
                });

                let latitude, longitude;
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        latitude = position.coords.latitude;
                        longitude = position.coords.longitude;
                    });
                }else{
                    console.log('Geolocation tidak didukung oleh browser.');
                    tombolKirim.prop('disabled',
                        false);
                        Swal.fire({
                        icon: 'error',
                        title: 'Lokasi Kamu Tidak Terdeteksi!',
                        text: 'Nyalakan atau Izinkan Akses Lokasi, Dan Refresh Untuk Memuat Halaman Kembali!',
                        timer: 900
                    });
                }

                captureBtn.addEventListener('click', () => {
                    var overlay = $('.fullscreen-overlay');
                    var loadingIcon = $('.loading-container');

                    overlay.show(); // Menampilkan layar penuh
                    loadingIcon.show(); // Menampilkan indikator loading
                    const canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    
                    const context = canvas.getContext('2d');
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);
                    
                    const imageUrl = canvas.toDataURL('image/png');
                    var id_student = $('#id_student').val();
                    var kode = $('#kode').val();
                $.ajax({
                    url: '/save-image',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    data: {
                        'image': imageUrl,
                        'latitude' : latitude,
                        'longitude' : longitude,
                        'id_student' : id_student,
                        'kode' : kode
                    },
                    success: function(data) {
                        if(data.msg == 'Berhasil'){
                            Swal.fire({
                                icon: 'success',
                                title: data.msg,
                                text: data.text,
                                timer: 900
                            });
                            window.location.href="/qrcode";
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: data.msg,
                                text: data.text,
                            });
                            window.location.href="/qrcode";
                        }
                    },
                    error: function(error) {
                        console.error('Error saving image:', error);
                        var errorText = 'Terjadi kesalahan';
                    // Tampilkan pesan error jika ada
                    if (error.responseJSON && error.responseJSON.errors) {
                        var errorMessages = error.responseJSON.errors;
                        for (var key in errorMessages) {
                            if (errorMessages.hasOwnProperty(key)) {
                                errorText = errorMessages[key][0];
                                break;
                            }
                        }
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorText,
                    });
                    },
                    complete: function() {
                        overlay.hide();
                        loadingIcon.hide();
                    }
                });

                // Tampilkan gambar yang diambil
                capturedImage.src = imageUrl;
                capturedImage.style.display = 'block';
            });
        });

    </script>

</body>
</html>
