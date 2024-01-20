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
                    render: function(data) {
                        // Assuming 'data' is in the format 'yyyy-mm-dd'
                        var dateObj = new Date(data);
                        var day = dateObj.getDate();
                        var month = dateObj.getMonth() + 1; // Months are zero-based
                        var year = dateObj.getFullYear().toString().slice(-2);

                        // Ensure leading zeros if needed
                        day = (day < 10) ? '0' + day : day;
                        month = (month < 10) ? '0' + month : month;

                        // Format the date as 'dd/mm/yy'
                        return day + '/' + month + '/' + year;
                    }
                },
                {
                    data: "time",
                },
                {
                    data: "status",
                    render: function(data){
                        if(data == 'Tepat'){
                            return '<div class="bg-success text-center w-100 rounded p-2">Tepat Waktu</div>';
                        }else{
                            return '<div class="bg-danger text-center w-100 p-2">Terlambat</div>';
                        }
                    }
                },
                {
                    data: "photo",
                    render: function(data){
                        return '<img class="w-100" src="/assets/image/'+data+'">';
                    }
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
                        return '<div class="d-flex"><a href="/assets/image/'+data.photo+'" target="_blank" title="Lihat Foto" class="btn text-white btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '"data-kode="" style="background:#1D60A2">Lihat Foto</a>' +
                            '<a title="Lihat Lokasi" href="https://www.google.com/maps?q='+data.latitude+','+data.longitude+'" target="_blank" class="btn text-white btn-sm mx-1" data-id="' +
                            data
                            .id +
                            '" style="background:#7CCCEF">Lihat Lokasi</a></div>';
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
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: "school_name",
                },
                {
                    data: "date",
                },
                {
                    data: "siswa_magang",
                },
                {
                    data: "siswa_hadir",
                },
                {
                    data: "sakit",
                },
                {
                    data: "izin",
                },
                {
                    data: "alpha",
                },
            ]
        });
    });
</script>