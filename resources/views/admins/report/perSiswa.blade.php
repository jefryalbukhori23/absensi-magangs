@extends('admins.layouts.base')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <table class="table w-100" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Tanggal Absensi</th>
                        <th>Jam Absensi</th>
                        <th>Keterangan</th>
                        <th>Foto</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Aksi</th>
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