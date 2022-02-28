<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_barang;
use Illuminate\Http\Request;

class PengajuanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengajuan_barang1/index' , [
            'pengajuan_barang1' => pengajuan_barang::all()
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_pengaju' => 'required',
            'nama_barang' => 'required',
            'tanggal_pengajuan' => 'required',
            'qty' => 'required'
        ]);

        $input = pengajuan_barang::create($validated);

        if($input) return redirect('#')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengajuan_barang  $pengajuan_barang
     * @return \Illuminate\Http\Response
     */
    public function show(pengajuan_barang $pengajuan_barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengajuan_barang  $pengajuan_barang
     * @return \Illuminate\Http\Response
     */
    public function edit(pengajuan_barang $pengajuan_barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengajuan_barang  $pengajuan_barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        pengajuan_barang::find($id)->update($request->all());
        return redirect('pengajuan_barang')->with('success', 'Data Barang Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengajuan_barang  $pengajuan_barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pengajuan_barang::find($id)->delete();
        return redirect('pengajuan_barang')->with('success', 'Barang Has Been Deleted');
    }

    public function updateDitarik(Request $request)
    {
        $data = pengajuan_barang::where('nama_pengaju', $request->nama_pengaju)->first();
        $data->ditarik = $request->ditarik;
        $update = $data->save();

        if($update)
            return 'Data Telah Ditarik!';
            
        return 'Data Gagal Ditarik!';
    }
}
