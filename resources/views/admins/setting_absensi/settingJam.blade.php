@extends('admins.layouts.base')

@section('content')
@include('admins.setting_absensi.modal')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <table class="table w-100" id="tables">
                <thead>
                    <tr>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Latitude Kantor</th>
                        <th>Longitude Kantor</th>
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
    @include('admins.setting_absensi.script')
@endsection