@extends('templates.layout')

@push('style')
  
@endpush

@section('content')
  <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Produk</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul>
              @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
              @endforeach
              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formProdukModal">
            Tambah Produk
          </button>

          <a href="{{ route('export_produk') }}" class="btn btn-success" target="_blank">
            Export XLS
          </a>

          @include('produk.data')
        </div>
       
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

  </section>
  @include('produk.form')
@endsection

@push('script')
  <script>
      $('#formProdukModal #nama_produk').first().focus();
      $('#data-produk').DataTable();


      $('.alert-success').fadeTo(2000,500).slideUp(500, function(){
        $('.alert-success').slideUp(500)
      })

     $('.remove').on('click', function(e){
      e.preventDefault()
      const data = $(this).closest('tr').find('td:eq(1)').text()
      $('#data-dihapus').text(data)

      const form = $(this).closest('tr').find('form')
      console.log(form)
      $('#btn-ya').on('click', function(){
        form.submit()
      })
     })

     //update or input
     $('#formProdukModal').on('show.bs.modal', function(e){
        const btn = $(e.relatedTarget)
        const modal = $(this)
        const mode = btn.data('mode')
        const id = btn.data('id')
        const nama_produk = btn.data('nama_produk')

        if(mode === 'edit'){
          modal.find('.modal-title').text('Edit Data')
          modal.find('#nama_produk').val(nama_produk)
          modal.find('#method').html('@method("PATCH")')
          modal.find('form').attr('action',`{{ url('produk') }}/${id}`)
        }else{
          modal.find('.modal-title').text('Form Produk')
          modal.find('#nama_produk').val('')
          modal.find('#method').html('')
          modal.find('form').attr('action','{{ url("produk") }}')
        }
     })

     $('#formProdukModal').on('shown.bs.modal', function(){
        $('#nama_produk').delay(1000).focus().select();
     })
     
  </script>
@endpush