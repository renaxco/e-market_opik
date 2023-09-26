<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;
use App\Models\Pembelian;
use App\Models\Pemasok;
use App\Models\Barang;
use App\Models\DetailPembelian;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastId = Pembelian::select('kode_masuk')->orderBy('created_at','desc')->first();
        $data['kode'] = ($lastId== null?'P00000001':sprintf('P%08d', substr($lastId->kode_masuk,1)+1));
        $data['pemasok'] = Pemasok::get();
        $data['barang'] = Barang::get();

        return view('pembelian/index')->with($data);
    }

    public function store(StorePembelianRequest $request)
    {
        //input pembelian
        $data['kode_masuk'] = $request['kode_masuk'];
        $data['tanggal_masuk'] = $request['tanggal_masuk'];
        $data['total'] = $request['total'];
        $data['pemasok_id'] = $request['pemasok_id'];
        $data['user_id'] = 1;

        $input_pembelian = Pembelian::create($data);
  
        //input detail pembelian
        $barang_id = $request->barang_id;
        $harga_beli = $request->harga_beli;
        $jumlah = $request->jumlah;
        $sub_total = $request->sub_total;
    
        foreach($barang_id as $i => $v){
            $data2['pembelian_id'] = $input_pembelian->id;
            $data2['barang_id'] = $barang_id[$i];
            $data2['harga_beli'] = $harga_beli[$i];
            $data2['jumlah'] = $jumlah[$i];
            $data2['sub_total'] = $sub_total[$i];
            $input_detail_pembelian = DetailPembelian::create($data2);
        }
        return redirect('pembelian')->with('success','input berhasil');
    }

    public function show(Pembelian $pembelian)
    {
        //
    }

    public function edit(Pembelian $pembelian)
    {
        //
    }

  
    public function update(UpdatePembelianRequest $request, Pembelian $pembelian)
    {
        //
    }

  
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
