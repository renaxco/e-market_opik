@extends('templates.layout')

@push('style')
  
@endpush

@section('content')
  <section class="content">
  
    <div class="card">
      <div class="card-header">
        <h3>Form</h3>
      </div>
      <div class="card-body">
        <form method="post" action="produk" id="form-pegawai">
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label">ID</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="id" placeholder="ID" name="id" autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label">Nama</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
          <div class="col-sm-8">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="jkl" value="L" name="jk">
              <label class="form-check-label" for="jkl" >Laki-Laki</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="jkp" value="P" name="jk">
              <label class="form-check-label" for="jkp" >Perempuan</label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label">Gaji</label>
          <div class="col-sm-8">
            <input type="number" class="form-control" id="gaji" placeholder="gaji" name="gaji" min="1000000" step="50000" value="1000000" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label">lembur</label>
          <div class="col-sm-1">
            <input type="number" class="form-control" id="lembur" name="lembur" min="0" step="1" value="0" required>
          </div>
          <div class="col-sm-1">hari</div>
        </div>
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label"></label>
          <div class="col-sm-2">
            <button type="submit" class="form-control btn btn-primary" id="btn-insert">Submit</button>
        </div>
        </div>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3>Data</h3>
      </div>
      <div class="card-body">
        <div class="mt-2 mb-2">
          <div class="form-group row mt-2">
            <div class="col-sm-2">
               <button class="btn btn-success" type="button" id="btn-sorting">Urutkan</button>  
            </div>
            <div class="col-sm-4">
              <input type="search" class="form-control" type="button" id="teks-cari">
            </div>
            <div class="col-sm-2">
              <button id="btn-search" class="btn btn-secondary">Cari</button>
            </div>
          </div>
        </div>
        <table class="table table-compact table-bordered table-hover" id="data-pegawai">
          <thead>
            <tr>
              <th>id</th>
              <th>Nama</th>
              <th>JK</th>
              <th>Gaji</th>
              <th>Lembur</th>
              <th>Bonus</th>
              <th>Pajak</th>
              <th>Total Gaji</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="6" align="center">Belum ada data</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </section>
@endsection

@push('script')
  <script>
    const hargaLembur = 100000
    function insertData(dataPegawai){
      const data = $('#form-pegawai').serializeArray()
      // console.log(data)

      let newData = {}
      data.forEach(function(item, index){
        let name = item['name']
        let value = name === 'id' || name == 'gaji' || name == 'lembur' ? Number(item['value']) : item['value']
        newData[name] = value
      })
      console.log(newData)

      localStorage.setItem('dataPegawai', JSON.stringify([...dataPegawai, newData]))
      return newData
    }
    function searching(arr, key, teks){
      for(let i= 0; i < arr.length; i++){
        if(arr[i][key] == teks)
          return i
        }
      return -1
    }

    function sorting(arr,key){
      let i,  j, id, value; 
      for (i = 1; i < arr.length; i++)
      { 
          value = arr[i]; 
          id = arr[i][key]
          j = i - 1; 
          while (j >= 0 && arr[j][key] > id)
          { 
              arr[j + 1] = arr[j]; 
              j = j - 1;  
          } 
          arr[j + 1] = value; 
      } 
      return arr
    }

    function showData(arr){
      let row = ''
      
      if(arr.length == 0){
        return row = `<tr><td colspan="3" align="center">Belum ada data</td></tr>`
      }

      let jmlGaji = jmlLembur = jmlTotal = jmlBonus = jmlPajak = 0
      arr.forEach(function(item, index){
        let bonus = item['lembur'] >= 10 ? item['gaji'] * 0.5 : 0
        let pajak = item['gaji'] * 0.1
        let total = item['gaji'] + (item['lembur'] * hargaLembur) + bonus - pajak
        jmlGaji += item['gaji']
        jmlLembur += item['lembur']
        jmlBonus+= bonus
        jmlPajak += pajak
        jmlTotal += total
        
        row += `<tr>`
        row += `<td>${item['id']}</td>`
        row += `<td>${item['nama']}</td>`
        row += `<td>${item['jk']}</td>`
        row += `<td>${item['gaji']}</td>`
        row += `<td>${item['lembur']}</td>`
        row += `<td>${bonus}</td>`
        row += `<td>${pajak}</td>`
        row += `<td>${total}</td>`
        row += `</tr>`       
      })
      row += '<tr style="font-weight:bold;background:#000;color:white">'
      row += `<td colspan="3">Jumlah Total</td>`
      row += `<td>${jmlGaji}</td>`
      row += `<td>${jmlLembur}</td>`
      row += `<td>${jmlBonus}</td>`
      row += `<td>${jmlPajak}</td>`
      row += `<td>${jmlTotal}</td>`
      row += '</tr>'
      return row
    }

    function filter(arr, key){
      // const data = arr.filter(r => r)
    }

    $(function(){
      //initialize
      let dataPegawai = JSON.parse(localStorage.getItem('dataPegawai')) || []
      $('#data-pegawai tbody').html(showData(dataPegawai))

      console.log(dataPegawai);
      // filter(dataPegawai, )

      //event klik input data
      $('#btn-insert').on('click',function(e){
        e.preventDefault()
        dataPegawai.push(insertData(dataPegawai)) 
        $('#data-pegawai tbody').html(showData(dataPegawai))
      })

      //event klik sorting
      $('#btn-sorting').on('click',function(){
        dataPegawai = sorting(dataPegawai, 'nama')
        localStorage.setItem('dataPegawai', JSON.stringify(dataPegawai))
        $('#data-pegawai tbody').html(showData(dataPegawai))
      })

      //event klik searching
      $('#btn-search').on('click',function(){
        let teksSearch = $('#teks-cari').val()
        let id = searching(dataPegawai,'nama', teksSearch)
        let data = []
        if(id >= 0)
          data.push(dataPegawai[id])
        console.log(id)
        console.log(data)
        $('#data-pegawai tbody').html(showData(data))
      })
    })
  </script>
@endpush