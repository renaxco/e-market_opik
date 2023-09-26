<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['produk'] = Produk::get();
        return view('produk.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
        DB::beginTransaction();
        try{
            Produk::create($request->all());
            return redirect('produk')->with('success','Data produk berhasil ditambahkan');
        }catch(QueryException $e){
            DB::rollBack();
            return redirect('guru')->with('error','Terjadi kesalahan query');
        }       
        DB::commit();

        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        dd($request->all());
        $produk->update($request->all());

        return redirect('produk')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Produk $produk)
    {
        dd($produk);
        $produk->delete();

        return redirect('produk')->with('success', 'Data berhasil dihapus');
    }

    public function exportData(){
        $fileName = date('Ymd').'_produk.xlsx';
        return Excel::download(new ProdukExport, $fileName);
    }
}
