<div class="mt-3">
  <table class="table table-striped table-bordered table-hover table-compact" id="data-produk">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Produk</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($produk as $p)
        <tr>
          <td>{{ $i = !isset($i)?1:++$i }}</td>
          <td>{{ $p->nama_produk }}</td>
          <td>
            <button type="button" class="btn btn-primary"     data-toggle="modal" data-target="#formProdukModal"
              data-mode = "edit"
              data-id = "{{ $p->id }}"
              data-nama_produk = "{{ $p->nama_produk }}"
            >
              <i class="far fa-edit"></i>
            </button>
            <form style="display:inline" method="post" 
            action="{{ route('produk.destroy', $p->id) }}">
            @csrf
            @method('DELETE')
              <button type="button" class="btn btn-danger remove" data-toggle="modal" data-target="#confirmModal">
                <i class="fas fa-times"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>


<!-- dialog konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         Apakah data <b id="data-dihapus"></b> akan dihapus?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger" id="btn-ya">Ya</button>
        </form>
      </div>
    </div>
  </div>
</div>