<script>
    $(document).ready(function() {
        var table = $('#table').DataTable({
            initComplete: function () {
                // Menyesuaikan elemen pencarian setelah tabel selesai diinisialisasi
                $('.dataTables_filter label').append('<i class="position-absolute fas fa-search" style="left: 15px; top: 15px; color: #BDBDBD"></i>');
                $('.dataTables_length label').append('<button type="button" class="btn btn-custom" data-toggle="modal" data-target="#exampleModal">Tambah siswa</button>');
                $('.dataTables_filter input').attr('placeholder', 'Cari...');
            },
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/schools',
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'id',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "school_name",
                },
                {
                    data: "type_school",
                },
                {
                    data: "npsn",
                },
                {
                    data: "email",
                },
                {
                    data: "telephone_number",
                },
                {
                    data: "address",
                },
                {
                    data: "headmaster",
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<div class="d-flex"><button title="Edit Data" class="btn btn-warning btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '"data-kode=" data-bs-toggle="modal" data-bs-target="#edit"><i class="fas fa-edit"></i></button>' +
                            '<button title="Hapus Data" class="btn btn-danger btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '" ><i class="fas fa-trash"></i></button></div>';
                    }
                },
            ]
        });

        //add
        $('#add_form').submit(function(e) {
            // alert('yo')
            e.preventDefault();

            var overlay = $('.fullscreen-overlay');
            var loadingIcon = $('.loading-container');

            overlay.show(); // Menampilkan layar penuh
            loadingIcon.show(); // Menampilkan indikator loading

            console.log(overlay);
            // return false;

            var tombolKirim = $(this).find('button[type="submit"]');

            tombolKirim.prop('disabled', true);
            tombolKirim.css('display', 'none');

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '/schools', // Ganti dengan URL rute Anda
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Tanggapan sukses, lakukan sesuatu (misalnya: tampilkan pesan sukses)
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses Simpan Data!',
                        text: 'Data Berhasil Ditambahkan',
                        timer: 900
                    });
                    table.ajax.reload();
                    $('#exampleModal').modal('hide');
                    $('#add_form')[0].reset();
                    // console.log(response.message);
                    // location.reload();
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
                },
                complete: function() {
                    tombolKirim.prop('disabled', false);
                    overlay.hide(); // Menyembunyikan layar penuh
                    loadingIcon.hide(); // Menyembunyikan indikator loading
                    tombolKirim.show();
                }
            });
        });

        // Edit
        $('.table').on('click', '.btn-warning', function() {
            var id = $(this).data('id');
            var data = $(this).data();
            $.ajax({
                url: '/schools/' + id,
                method: 'GET',
                success: function(response) {
                    console.log(response)
                    // Menampilkan form edit pada modal
                    $('#edit-isi').html(
                        '<form action="" id="editform" enctype="multipart/form-data">' +
                            '@csrf' +
                            '@method('PUT')'+
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Nama Sekolah</label>' +
                        '<input type="text" class="form-control" value="'+response.school_name+'" id="school_name" name="school_name" placeholder="Nama Sekolah">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="message-text" class="col-form-label">Tipe Sekolah</label><br>' +
                        '<input class="" type="radio" name="type_school" '+ (response.type_school === "Negeri" ? "checked" : "") +' id="gridRadios1" value="Negeri">' +
                        'Negeri <br>' +
                        '<input class="" type="radio" '+ (response.type_school === "Swasta" ? "checked" : "") +' name="type_school" id="gridRadios2" value="Swasta">' +
                        'Swasta' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">NPSN</label>' +
                        '<input type="number" class="form-control" value="'+response.npsn+'" id="npsn" name="npsn" placeholder="NPSN">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Email</label>' +
                        '<input type="email" class="form-control" value="'+response.email+'" id="email" name="email" placeholder="Email">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Telepon</label>' +
                        '<input type="number" class="form-control" value="'+response.telephone_number+'" id="telephone_number" name="telephone_number" placeholder="Telepon">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Alamat</label>' +
                        '<input type="text" class="form-control" value="'+response.address+'" id="alamat" name="address" placeholder="Alamat">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Pembimbing PKL</label>' +
                        '<input type="text" class="form-control" value="'+response.headmaster+'" id="headmaster" name="headmaster" placeholder="Pembimbing PKL">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="recipient-name" class="col-form-label">Logo Sekolah</label>' +
                        '<input type="file" class="form-control" id="logo" name="logo" placeholder="Logo Sekolah">' +
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
                            url: '/schools/' + id,
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
                                    text: 'Berhasil Update Data Sekolah',
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

        // hapus
        $('.table').on('click', '.btn-danger', function() {
            var id = $(this).data('id');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Tampilkan konfirmasi penghapusan menggunakan Swal Alert
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus data sekolah ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi penghapusan, kirim permintaan Ajax ke server untuk menghapus data
                    $.ajax({
                        url: '/schools/' + id,
                        type: 'DELETE',
                        headers: {
                            // Menambahkan token CSRF ke header permintaan
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log(
                                response); // Menampilkan respons dari server
                            Swal.fire('Berhasil', 'Data berhasil dihapus',
                                'success');
                            table.ajax.reload();
                            // location.reload();

                        },
                        error: function(error) {
                            console.log(
                                error
                            ); // Menampilkan pesan error jika permintaan gagal
                            Swal.fire('Error',
                                'Terjadi kesalahan saat menghapus data, Coba lagi nanti',
                                'error', 900);
                        }
                    });
                }
            });
        });
    });
</script>
