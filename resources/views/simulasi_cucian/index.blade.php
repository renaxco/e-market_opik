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
        <form  id="form-cucian">
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label">No Transaksi</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="id" placeholder="ID" name="id" autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label">No. HP/WA</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nophone" placeholder="nophone" name="nophone" autofocus required>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label">Jenis Cucian</label>
          <div class="col-sm-8">
            <select class="form-control" id="jenisCucian" name="jenisCucian" required>
              <option value="standar">Standar</option>
              <option value="ekpress">Ekpress</option>
            </select> 
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class="col-sm-4 col-form-label">Nama</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="tgl" class="col-sm-4 col-form-label">Tanggal Cucian</label>
          <div class="col-sm-8">
            <input type="date" class="form-control" id="tgl" placeholder="tgl" name="tgl" required>
          </div>
        </div>
       <div class="form-group row">
          <label for="berat" class="col-sm-4 col-form-label">Berat Cucian</label>
          <div class="col-sm-8">
            <input type="number" class="form-control" id="berat" min='3' value="3" name="berat" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama-produk" class="col-sm-4 col-form-label"></label>
          <div class="col-sm-2">
            <button type="button" class="form-control btn btn-primary" id="btn-insert">Submit</button>
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
            <div class="col-sm-3">
              <input type="checkbox" name="filter" id="standar" class="filter" value="standar">Standar
              <input type="checkbox" name="filter" id="ekpress" class="filter" value="ekpress">ekpress
            </div>
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
        <table class="table table-compact table-bordered table-hover" id="data-cucian">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Kontak</th>
              <th>Tgl Cuci</th>
              <th>Jenis Cucian</th>
              <th>Berat</th>
              <th>Diskon</th>
              <th>Total Harga</th>
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
    
    function insertData(dataCucian){
      const data = $('#form-cucian').serializeArray()
      // console.log(data)

      let newData = {}
      data.forEach(function(item, index){
        let name = item['name']
        let value = name === 'id' || name == 'berat' ? Number(item['value']) : item['value']
        newData[name] = value
      })
      console.log(newData)

      localStorage.setItem('dataCucian', JSON.stringify([...dataCucian, newData]))
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
        return row = `<tr><td colspan="8" align="center">Belum ada data</td></tr>`
      }

      let jmlBerat = jmlDiskon = jmlTotal  = 0
      arr.forEach(function(item, index){
        let harga = item['jenisCucian'] == 'standar' ? 7500 : 10000
        let jmlHarga = harga * item['berat']
        let diskon = jmlHarga >= 50000 ? harga * 0.1 : 0
        let total = jmlHarga - diskon
  
        jmlBerat += item['berat']
        jmlDiskon += diskon
        jmlTotal += total
        
        row += `<tr>`
        row += `<td>${item['id']}</td>`
        row += `<td>${item['nama']}</td>`
        row += `<td>${item['nophone']}</td>`
        row += `<td>${item['tgl']}</td>`
        row += `<td>${item['jenisCucian']}</td>`
        row += `<td>${item['berat']}</td>`
        row += `<td>${diskon}</td>`
        row += `<td>${total}</td>`
        row += `</tr>`       
      })
      row += '<tr style="font-weight:bold;background:#000;color:white">'
      row += `<td colspan="5">Jumlah Total</td>`
      row += `<td>${jmlBerat}</td>`
      row += `<td>${jmlDiskon}</td>`
      row += `<td>${jmlTotal}</td>`
      row += '</tr>'
      return row
    }
    
    
    function filter(arrays, key){
      let filtered = []
      key.forEach((i) => {
        x = arrays.filter(array => array['jenisCucian'] == i )
        filtered = [...filtered, ...x]
      })
      return filtered
    }

    $(function(){
      //initialize
      let dataCucian = JSON.parse(localStorage.getItem('dataCucian')) || []
      $('#data-cucian tbody').html(showData(dataCucian))


      // filter
      $('.filter').on('click', function(){
        const checked = [...document.querySelectorAll('.filter:checked')].map(e => e.value);
        const data = filter(dataCucian, checked)
        $('#data-cucian tbody').html(showData(data))
      })

      //event klik input data
      $('#btn-insert').on('click',function(e){
        e.preventDefault()
        dataCucian.push(insertData(dataCucian)) 
        $('#data-cucian tbody').html(showData(dataCucian))
      })

      //event klik sorting
      $('#btn-sorting').on('click',function(){
        dataCucian = sorting(dataCucian, 'nama')
        localStorage.setItem('dataCucian', JSON.stringify(dataCucian))
        $('#data-cucian tbody').html(showData(dataCucian))
      })

      //event klik searching
      $('#btn-search').on('click',function(){
        let teksSearch = $('#teks-cari').val()
        let id = searching(dataCucian,'nama', teksSearch)
        let data = []
        if(id >= 0)
          data.push(dataCucian[id])
        console.log(id)
        console.log(data)
        $('#data-cucian tbody').html(showData(data))
      })
    })
  </script>
@endpush