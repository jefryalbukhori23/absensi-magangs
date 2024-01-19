<script>
        $(document).ready(function() {
        var table = $('#tables').DataTable({
            initComplete: function () {
                // Menyesuaikan elemen pencarian setelah tabel selesai diinisialisasi
                $('.dataTables_filter label').append('<i class="position-absolute fas fa-search" style="left: 15px; top: 15px; color: #BDBDBD"></i>');
                // $('.dataTables_length label').append('<button type="button" class="btn btn-custom" data-toggle="modal" data-target="#exampleModal">Tambah siswa</button>');
                $('.dataTables_filter input').attr('placeholder', 'Cari...');
            },
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/get_data_absensi',
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
                    data: "fullname",
                },
                {
                    data: "nisn",
                },
                {
                    data: "date",
                },
                {
                    data: "time",
                },
                {
                    data: "status",
                },
                {
                    data: "photo",
                },
                {
                    data: "latitude",
                },
                {
                    data: "longitude",
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<div class="d-flex"><button title="Lihat Foto" class="btn text-white btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '"data-kode=" style="background:#1D60A2">Lihat Foto</button>' +
                            '<button title="Lihat Lokasi" class="btn text-white btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '" style="background:#1D60A2"></button></div>';
                    }
                },
            ]
        });

        // tables persekolah
        var table = $('#tables2').DataTable({
            initComplete: function () {
                // Menyesuaikan elemen pencarian setelah tabel selesai diinisialisasi
                $('.dataTables_filter label').append('<i class="position-absolute fas fa-search" style="left: 15px; top: 15px; color: #BDBDBD"></i>');
                // $('.dataTables_length label').append('<button type="button" class="btn btn-custom" data-toggle="modal" data-target="#exampleModal">Tambah siswa</button>');
                $('.dataTables_filter input').attr('placeholder', 'Cari...');
            },
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                url: '/get_data_absensi_persekolah',
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
                    data: "fullname",
                },
                {
                    data: "nisn",
                },
                {
                    data: "date",
                },
                {
                    data: "time",
                },
                {
                    data: "status",
                },
                {
                    data: "photo",
                },
                {
                    data: "latitude",
                },
                {
                    data: "longitude",
                },
            ]
        });
    });
</script>