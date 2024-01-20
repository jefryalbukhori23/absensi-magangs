@extends('admins.layouts.base')

@section('content')
    @include('admins.Users.modal')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row flex-column">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Pengguna
            </button>
            <table class="table w-100" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
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
@include('admins.Users.script')
    
@endsection