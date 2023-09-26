<div class="mt-5">
  <table id="data-guru" class="table table-striped table-sm table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>JK</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($guru as $g)
        <tr>
          <td>{{ $i=!isset($i)?1:++$i }}</td>
          <td>{{ $g['nip'] }}</td>
          <td>{{ $g['nama'] }}</td>
          <td>{{ $g['jenisKelamin'] }}</td>
          <td>Edit | Delete</td>
        </tr>  
      @endforeach
    </tbody>
  </table>
</div>