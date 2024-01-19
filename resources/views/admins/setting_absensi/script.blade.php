@include('admins.setting_absensi.modal')
<script>
    $(document).ready(function() {
        var table = $('#tables').DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/setting_absensi',
                type: 'GET',
                dataType: 'json'
            },
            columns: [
                {
                    data: 'entry_time'
                },
                {
                    data: 'home_time'
                },
                {
                    data: 'office_latitude'
                },
                {
                    data: 'office_longitude'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<div class="d-flex"><button title="Edit Data" class="btn btn-warning btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '" data-bs-toggle="modal" data-bs-target="#edit"><i class="fas fa-edit"></i></button></div>';
                    }
                }
            ]
        });

        // Edit
        $('.table').on('click', '.btn-warning', function() {
            var id = $(this).data('id');
            var data = $(this).data();
            $.ajax({
                url: '/setting_absensi/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response.gender)
                    // Menampilkan form edit pada modal
                    $('#edit-isi').html(
                        '<form action="" id="editform" enctype="multipart/form-data">' +
                        '@csrf' +
                        '@method('PUT')' +
                        '<div class="form-group">' +
                        '<label for="fullname">Jam Masuk:</label>' +
                        '<input type="time" class="form-control" id="fullname" value="' +
                        response.entry_time + '" name="entry_time">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="email">Jam Pulang:</label>' +
                        '<input type="time" class="form-control" id="email" value="' +
                        response.home_time + '" name="home_time">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="nisn">Latitude Kantor:</label>' +
                        '<input type="text" class="form-control" id="nisn" value="' +
                        response.office_latitude + '" name="office_latitude">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="place_birth">Longitude Kantor:</label>' +
                        '<input type="text" value="' + response.office_longitude +
                        '" class="form-control" id="place_birth" name="office_longitude">' +
                        '</div>' +
                        '<div><button type="submit" class="btn btn-primary">Edit</button></div>' +
                        '</form>'
                    );

                    // Tampilkan modal
                    $('#edit').modal('show');

                    // Mengirim permintaan Ajax untuk mengupdate data ketika form disubmit
                    $('#editform').submit(function(event) {
                        event.preventDefault();

                        var overlay = $('.fullscreen-overlay');
                        var loadingIcon = $('.loading-container');

                        overlay.show(); // Menampilkan layar penuh
                        loadingIcon.show(); // Menampilkan indikator loading

                        var tombolKirim = $(this).find('button[type="submit"]');

                        tombolKirim.prop('disabled', true);
                        tombolKirim.css('display', 'none');

                        var formData = new FormData(this);

                        $.ajax({
                            url: '/setting_absensi/' + id,
                            method: 'POST',
                            data: formData, // Mengirim objek FormData
                            processData: false, // Tidak memproses data secara otomatis
                            contentType: false, // Mengabaikan tipe konten secara otomatis
                            success: function(response) {
                                console.log(response);
                                $('#edit').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Berhasil Update Data',
                                    timer: 900
                                });
                                table.ajax.reload();
                                // location.reload();
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
                            },
                            complete: function() {
                                tombolKirim.prop('disabled', false);
                                overlay
                            .hide(); // Menyembunyikan layar penuh
                                loadingIcon
                            .hide(); // Menyembunyikan indikator loading
                                tombolKirim.show();
                            }
                        });
                    });
                },
                error: function(error) {
                    console.log(error);
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
                }
            });
        });
    });
</script>
