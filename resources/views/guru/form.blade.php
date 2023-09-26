<!-- Modal -->
<div class="modal fade" id="formGuruModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="guru">
          @csrf
          <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
            </div>
          </div>
          <div class="form-group row">
            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
            </div>
          </div>
          <div class="form-group row">
            <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
             <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenisKelamin" id="jkl" value="L">
                <label class="form-check-label" for="jkl">Laki-Laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenisKelamin" id="jkp" value="P">
                <label class="form-check-label" for="jkp">Perempuan</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="tempatLahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" placeholder="Tempat Lahir">
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggalLahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" placeholder="Tanggal Lahir">
            </div>
          </div>
          <div class="form-group row">
            <label for="nik" class="col-sm-4 col-form-label">NIK</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK">
            </div>
          </div>
          <div class="form-group row">
            <label for="agama" class="col-sm-4 col-form-label">Agama</label>
            <div class="col-sm-8">
              <select type="text" class="form-control" id="agama" name="agama" placeholder="agama">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
            <div class="col-sm-8">
              <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
      </div>
    </div>
  </div>
</div>
</form>