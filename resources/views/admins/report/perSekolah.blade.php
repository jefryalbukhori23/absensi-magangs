@extends('admins.layouts.base')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <table class="table w-100" id="tables2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>Tanggal Absensi</th>
                        <th>Jumlah Siswa Magang</th>
                        <th>Jumlah Hadir</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Alpha</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
@section('script')
    @include('admins.report.script')
@endsection