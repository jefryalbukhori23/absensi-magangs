@extends('admins.layouts.base')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column qr-screen">
            <div class="" style="cursor: pointer" data-widget="pushmenu" >
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                <path d="M1.5625 8.78906V2.73438C1.5625 2.08496 2.08496 1.5625 2.73438 1.5625H8.78906C9.11133 1.5625 9.375 1.82617 9.375 2.14844V4.10156C9.375 4.42383 9.11133 4.6875 8.78906 4.6875H4.6875V8.78906C4.6875 9.11133 4.42383 9.375 4.10156 9.375H2.14844C1.82617 9.375 1.5625 9.11133 1.5625 8.78906ZM15.625 2.14844V4.10156C15.625 4.42383 15.8887 4.6875 16.2109 4.6875H20.3125V8.78906C20.3125 9.11133 20.5762 9.375 20.8984 9.375H22.8516C23.1738 9.375 23.4375 9.11133 23.4375 8.78906V2.73438C23.4375 2.08496 22.915 1.5625 22.2656 1.5625H16.2109C15.8887 1.5625 15.625 1.82617 15.625 2.14844ZM22.8516 15.625H20.8984C20.5762 15.625 20.3125 15.8887 20.3125 16.2109V20.3125H16.2109C15.8887 20.3125 15.625 20.5762 15.625 20.8984V22.8516C15.625 23.1738 15.8887 23.4375 16.2109 23.4375H22.2656C22.915 23.4375 23.4375 22.915 23.4375 22.2656V16.2109C23.4375 15.8887 23.1738 15.625 22.8516 15.625ZM9.375 22.8516V20.8984C9.375 20.5762 9.11133 20.3125 8.78906 20.3125H4.6875V16.2109C4.6875 15.8887 4.42383 15.625 4.10156 15.625H2.14844C1.82617 15.625 1.5625 15.8887 1.5625 16.2109V22.2656C1.5625 22.915 2.08496 23.4375 2.73438 23.4375H8.78906C9.11133 23.4375 9.375 23.1738 9.375 22.8516Z" fill="black"/>
                </svg>
            </div>
            <h1 class="header mt-2">
                QR Scan
            </h1>
            <div class="d-flex flex-column align-items-center jusitfy-content-center">
                <h1 class="hour">
                    07.13
                </h1>
                <p class="date">
                    SABTU, 13 JANUARI 2024
                </p>
                <div class="box-qr">
                    {!! QrCode::size(300)->generate($qr->qrQode); !!}
                </div>
                <p class="subText">
                    Scan QR Code diatas
                </p>
                <div class="d-flex align-items-center flex-wrap justify-content-center mb-5">
                    <div class="m-2 box-custom d-flex align-items-center jusitfy-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none">
                            <path d="M16.5 27.5C21.8195 27.5 26.125 23.1945 26.125 17.875C26.125 12.5555 21.8195 8.25 16.5 8.25C11.1805 8.25 6.875 12.5555 6.875 17.875C6.875 23.1945 11.1805 27.5 16.5 27.5ZM23.1 30.25H22.3867C20.5992 31.1094 18.6141 31.625 16.5 31.625C14.3859 31.625 12.4094 31.1094 10.6133 30.25H9.9C4.43437 30.25 0 34.6844 0 40.15V42.625C0 44.9023 1.84766 46.75 4.125 46.75H28.875C31.1523 46.75 33 44.9023 33 42.625V40.15C33 34.6844 28.5656 30.25 23.1 30.25ZM41.25 27.5C45.8047 27.5 49.5 23.8047 49.5 19.25C49.5 14.6953 45.8047 11 41.25 11C36.6953 11 33 14.6953 33 19.25C33 23.8047 36.6953 27.5 41.25 27.5ZM45.375 30.25H45.0484C43.8539 30.6625 42.5906 30.9375 41.25 30.9375C39.9094 30.9375 38.6461 30.6625 37.4516 30.25H37.125C35.3719 30.25 33.7562 30.757 32.3383 31.5734C34.4352 33.8336 35.75 36.8328 35.75 40.15V43.45C35.75 43.6391 35.707 43.8195 35.6984 44H50.875C53.1523 44 55 42.1523 55 39.875C55 34.5555 50.6945 30.25 45.375 30.25Z" fill="#1D60A2"/>
                        </svg>
                        <div class="d-flex flex-column items-center justify-content-start">
                            <p class="subHeader">Siswa Sudah Absen</p>
                            <p class="number mb-3"><span id="jml-siswa"></span> Siswa</p>
                            <p class="subHeader">Jumlah Siswa</p>
                            <p class="number">{{ $siswa->count() }} Siswa</p>
                        </div>
                    </div>
                    <div class="m-2 box-custom d-flex align-items-center jusitfy-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 68 68" fill="none">
                        <path d="M34 1.0625C15.8047 1.0625 1.0625 15.8047 1.0625 34C1.0625 52.1953 15.8047 66.9375 34 66.9375C52.1953 66.9375 66.9375 52.1953 66.9375 34C66.9375 15.8047 52.1953 1.0625 34 1.0625ZM41.5836 47.5602L29.8695 39.0469C29.4578 38.7414 29.2188 38.2633 29.2188 37.7586V15.4062C29.2188 14.5297 29.9359 13.8125 30.8125 13.8125H37.1875C38.0641 13.8125 38.7812 14.5297 38.7812 15.4062V33.6945L47.2148 39.8305C47.932 40.3484 48.0781 41.3445 47.5602 42.0617L43.8148 47.2148C43.2969 47.9188 42.3008 48.0781 41.5836 47.5602Z" fill="#1D60A2"/>
                        </svg>
                        <div class="d-flex flex-column items-center justify-content-start">
                            <p class="subHeader">Jam Masuk</p>
                            <p class="number mb-3">{{ substr($sett->entry_time, 0, 5) }}</p>
                        </div>
                    </div>
                    <div class="m-2 box-custom d-flex align-items-center jusitfy-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 68 68" fill="none">
                        <path d="M34 1.0625C15.8047 1.0625 1.0625 15.8047 1.0625 34C1.0625 52.1953 15.8047 66.9375 34 66.9375C52.1953 66.9375 66.9375 52.1953 66.9375 34C66.9375 15.8047 52.1953 1.0625 34 1.0625ZM41.5836 47.5602L29.8695 39.0469C29.4578 38.7414 29.2188 38.2633 29.2188 37.7586V15.4062C29.2188 14.5297 29.9359 13.8125 30.8125 13.8125H37.1875C38.0641 13.8125 38.7812 14.5297 38.7812 15.4062V33.6945L47.2148 39.8305C47.932 40.3484 48.0781 41.3445 47.5602 42.0617L43.8148 47.2148C43.2969 47.9188 42.3008 48.0781 41.5836 47.5602Z" fill="#1D60A2"/>
                        </svg>
                        <div class="d-flex flex-column items-center justify-content-start">
                            <p class="subHeader">Jam Pulang</p>
                            <p class="number mb-3">{{ substr($sett->home_time, 0, 5) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
@section('script')
    @include('admins.qrQode.script')
@endsection