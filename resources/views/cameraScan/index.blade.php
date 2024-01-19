<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link rel="icon" href="{{asset('assets/image/ds.png')}}" type="image/x-icon">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            padding: 0;
            margin: 0;
            background-color: black;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .camera {
            width: auto;
            height: 100dvh;
            margin: 0;
            padding: 0;
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
    <video class="camera" id="preview"></video>
    <!-- <div id="resultText"></div> -->

    <!-- Add this in your Blade view file -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
    var overlay = $('.fullscreen-overlay');
                    var loadingIcon = $('.loading-container');
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });

        // Function to update the result text
        function updateResultText(content) {
            $('#resultText').text('Scanned Result: ' + content);
        }

        scanner.addListener('scan', function(content) {
            console.log(content);
            updateResultText(content); // Call the function to update the result text
                    overlay.show(); // Menampilkan layar penuh
                    loadingIcon.show(); // Menampilkan indikator loading
            $.ajax({
                url: '/addscan/'+content,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if(response.msg == 'Berhasil')
                    {
                        overlay.hide();
                        loadingIcon.hide();
                      Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Scan',
                        text: response.text,
                        timer:900
                      });
                      overlay.show(); // Menampilkan layar penuh
                    loadingIcon.show(); // Menampilkan indikator loading
                    }else if(response.msg == 'Gagal'){
                      Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.text,
                    });
                    overlay.hide();
                        loadingIcon.hide();
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi Kesalahan, Coba Lagi',
                      });
                      overlay.hide();
                        loadingIcon.hide();
                    }
                },
                error: function(error) {
                    console.log(error);
                    var errorText = 'Terjadi kesalahan';
                    // Tampilkan pesan error jika ada
                    if (error.responseJSON && error
                        .responseJSON.errors) {
                        var errorMessages = error
                            .responseJSON.errors;
                        for (var key in errorMessages) {
                            if (errorMessages
                                .hasOwnProperty(key)) {
                                errorText = errorMessages[
                                    key][0];
                                break;
                            }
                        }
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorText,
                    });
                    overlay.hide();
                        loadingIcon.hide();
                },
            });
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
                Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mengakses Kamera',
                        text: 'Refresh Halaman Untuk Load Halaman Kembali',
                    });
            }
        }).catch(function(e) {
            console.error(e);
            Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan System',
                        text: 'Coba Lagi Nanti',
                    });
        });

        function cekScan()
        {
            $.ajax({
                url: '/cek_photo', // Ganti dengan URL yang sesuai
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if(data.status == 'S')
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Kamu Berhasil Presensi!',
                        });
                        window.location.href="/profil-user";
                    }else if(data.status == 'GL'){
                        overlay.show(); // Menampilkan layar penuh
                    loadingIcon.show(); // Menampilkan indikator loading
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Melakukan Presensi',
                            text: 'Kamu Tidak Berada di Kantor',
                        });
                        overlay.hide();
                        loadingIcon.hide();
                    }else if(data.status == 'GI'){
                        overlay.show(); // Menampilkan layar penuh
                    loadingIcon.show(); // Menampilkan indikator loading
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Melakukan Presensi',
                            text: 'Kamu Melakukan Tindakan Ilegal',
                        });
                        overlay.hide();
                        loadingIcon.hide();
                    }else if(data.status == 'TA'){
                        overlay.hide();
                        loadingIcon.hide();
                    }else if(data.status == 'F'){
                        overlay.show(); // Menampilkan layar penuh
                        loadingIcon.show(); // Menampilkan indikator loading
                    }
                    else{
                        overlay.hide();
                        loadingIcon.hide();

                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                    var errorText = 'Terjadi kesalahan';
                                // Tampilkan pesan error jika ada
                                if (error.responseJSON && error
                                    .responseJSON.errors) {
                                    var errorMessages = error
                                        .responseJSON.errors;
                                    for (var key in errorMessages) {
                                        if (errorMessages
                                            .hasOwnProperty(key)) {
                                            errorText = errorMessages[
                                                key][0];
                                            break;
                                        }
                                    }
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: errorText,
                                });
                    overlay.hide();
                    loadingIcon.hide();
                }
            });
        }

        // Panggil fungsi fetchData secara berkala setiap 5 detik
        setInterval(function() {
            cekScan();
        }, 5000); // 5000 milidetik = 5 detik
    </script>


</body>

</html>
