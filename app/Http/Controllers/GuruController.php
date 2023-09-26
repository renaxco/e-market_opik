<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GuruExport;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['guru'] = Guru::all();
        return view('guru.index')->with($data);
    }

    public function store(StoreGuruRequest $request)
    {
        DB::beginTransaction();
        try{
            Guru::create($request->all());
            return redirect('guru')->with('success','Data guru berhasil ditambahkan');
        }catch(QueryException $e){
            DB::rollBack();
            return redirect('guru')->with('error','Terjadi kesalahan query');
        }       
        DB::commit();
    }

    public function show(Guru $guru)
    {
        //
    }

    public function edit(Guru $guru)
    {
        //
    }

    
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        //
    }

    public function destroy(Guru $guru)
    {
        //
    }

    public function export() 
    {
        return Excel::download(new GuruExport, 'guru.xlsx');
    }
}
