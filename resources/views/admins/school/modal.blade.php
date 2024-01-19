<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_form" method="POST" class="p-2">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" id="school_name" name="school_name"
                            placeholder="Nama Sekolah">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tipe Sekolah</label><br>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="form-check d-flex align-items-center mr-5">
                                <input class="form-check-input custom" type="radio" name="type_school" id="gridRadios1" value="Negeri">
                                <label for="gridRadios1" class="form-check-label">
                                    Negeri
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center ml-5">
                                <input class="form-check-input custom" type="radio" name="type_school" id="gridRadios2" value="Swasta">
                                <label for="gridRadios2" class="form-check-label">
                                    Swasta
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">NPSN</label>
                        <input type="number" class="form-control" id="npsn" name="npsn" placeholder="NPSN">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Telepon</label>
                        <input type="number" class="form-control" id="telephone_number" name="telephone_number" placeholder="Telepon">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="address" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Pembimbing PKL</label>
                        <input type="text" class="form-control" id="headmaster" name="headmaster"
                        placeholder="Pembimbing PKL">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Logo Sekolah</label>
                        <div class="custom-file">
                            <label for="recipient-name" class="custom-file-label">Masukkan Logo</label>
                            <input type="file" class="custom-file-input" id="logo" name="logo"
                                placeholder="Logo Sekolah">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="w-100 btn btn-custom">Simpan</button>
                    <button type="button" class="w-100 btn btn-transparent" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit --}}
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Sekolah</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit-isi">

            </div>
        </div>
    </div>
</div>
