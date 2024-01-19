@extends('admins.layouts.base')

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <div class="container">
                <table class="table w-100" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>Negara / Swasta</th>
                        <th>NPSN</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Pembimbing Pkl</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    
    @include('admins.school.modal')

@endsection

@section('script')
@include('admins.school.script')
@endsection