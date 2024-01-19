<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_form" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Sekolah</label>
                        <select name="id_school" id="" class="form-control">
                            <option value="" disabled selected> -- Pilih Sekolah -- </option>
                            @foreach ($schools as $item)
                            <option value="{{ $item->id }}">{{ $item->school_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="school_name" name="fullname"
                            placeholder="Nama Siswa">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Jenis Kelamin</label><br>
                        <input class="" type="radio" name="gender" id="gridRadios1" value="L">
                        L <br>
                        <input class="" type="radio" name="gender" id="gridRadios2" value="P">
                        P
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
                        <label for="recipient-name" class="col-form-label">NISN</label>
                        <input type="number" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="place_birth" name="place_birth" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Tanggal Lahir">
                    </div>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit-isi">

            </div>
        </div>
    </div>
</div>
