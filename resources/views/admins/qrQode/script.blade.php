<script>
    function updateClock() {
        // Mendapatkan elemen dengan kelas "hour"
        var hourElement = document.querySelector('.hour');

        // Mendapatkan waktu saat ini
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();

        // Format jam dan menambahkan nol jika perlu
        var formattedTime = (hours < 10 ? '0' : '') + hours + '.' + (minutes < 10 ? '0' : '') + minutes;

        // Mengganti isi elemen dengan waktu yang sudah diformat
        hourElement.textContent = formattedTime;
    }

    // Memanggil fungsi updateClock setiap detik (1000 milidetik)
    setInterval(updateClock, 1000);

    // Memanggil fungsi updateClock untuk pertama kali saat halaman dimuat
    updateClock();

    function updateClockAndDate() {
        // Mendapatkan elemen dengan kelas "hour" dan "date"
        var hourElement = document.querySelector('.hour');
        var dateElement = document.querySelector('.date');

        // Mendapatkan waktu saat ini
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();

        // Format jam dan menambahkan nol jika perlu
        var formattedTime = (hours < 10 ? '0' : '') + hours + '.' + (minutes < 10 ? '0' : '') + minutes;

        // Format tanggal
        var daysOfWeek = ['MINGGU', 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
        var day = daysOfWeek[currentTime.getDay()];
        var date = currentTime.getDate();
        var monthNames = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
        var month = monthNames[currentTime.getMonth()];
        var year = currentTime.getFullYear();

        // Format tanggal lengkap
        var formattedDate = day + ', ' + date + ' ' + month + ' ' + year;

        // Mengganti isi elemen dengan waktu dan tanggal yang sudah diformat
        hourElement.textContent = formattedTime;
        dateElement.textContent = formattedDate;
    }

    // Memanggil fungsi updateClockAndDate untuk pertama kali saat halaman dimuat
    updateClockAndDate();

    // Fungsi untuk mengambil data dari controller
    function fetchData() {
        $.ajax({
            url: '/get-jlm-siswa', // Ganti dengan URL yang sesuai
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Manipulasi data atau tampilkan data di tempat yang sesuai
                $('#jml-siswa').html(data);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function cekScan()
    {
        $.ajax({
            url: '/cek_scan', // Ganti dengan URL yang sesuai
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if(data.msg == 'success')
                {
                    var overlay = $('.fullscreen-overlay');
                    var loadingIcon = $('.loading-container');

                    overlay.show(); // Menampilkan layar penuh
                    loadingIcon.show(); // Menampilkan indikator loading
                    // alert('ada', data.data.fullname)
                    window.location.href="/FaceScan/"+data.data.id+'/'+data.scan.id;
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Panggil fungsi fetchData secara berkala setiap 5 detik
    setInterval(function() {
        fetchData();
        cekScan();
    }, 5000); // 5000 milidetik = 5 detik
</script>