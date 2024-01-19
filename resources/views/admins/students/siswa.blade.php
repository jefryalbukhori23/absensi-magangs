@extends('admins.layouts.base')

@section('content')
    @include('admins.students.modal')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah siswa
            </button>
            <table class="table w-100" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NISN</th>
                        <th>Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Telepon</th>
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
@include('admins.students.script')
    
@endsection