<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPembelian;
use App\Models\Pemasok;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pembelian/index', [
            'pembelian' => Pembelian::all(),
            'barang' => Barang::all(),
            'pemasok' => Pemasok::all(),
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
        // Mengirimkan dan menampilkan data berbentuk array
        // dd($request);

        // pembuatan ID Pembelian
        $d = Pembelian::orderBy('id', 'desc')->first();
        $urutan = ($d == null?1:substr($d->kode_masuk, 5, 6)+1);

        $kode_masuk = sprintf('P'.date('Y').'%06d', $urutan);
        // dd($kode_masuk);

        // Validation / Validasi
        $validated = $request->validate([
            'tanggal_masuk' =>'required',
            'total' =>'required',
            'pemasok_id' =>'required',
            'barang_id' =>'required',
            'harga_beli' =>'required',
            'jumlah' =>'required',
            'sub_total' =>'required'
        ]);
        $validated['kode_masuk'] = $kode_masuk;
        $validated['user_id'] = 1;

        // Input Pembelian
        $input_pembelian = Pembelian::create($validated);
        if($input_pembelian == null) return "data gagal diinput";

        // Input Detail Pembelian 
        $barang_id = $request->barang_id;
        $harga_beli = $request->harga_beli;
        $jumlah = $request->jumlah;
        $sub_total = $request->sub_total;



        foreach($barang_id as $i => $v){
            // echo $barang_id[$i]."|".$harga_beli[$i]."|".$jumlah[$i]."|"
            // .$sub_total[$i]."<br>";
            $validated['pembelian_id'] = $input_pembelian->id;
            $validated['barang_id'] = $barang_id[$i];
            $validated['harga_beli'] = $harga_beli[$i];
            $validated['jumlah'] = $jumlah[$i];
            $validated['sub_total'] = $sub_total[$i];
            $input_detail_pembelian = DetailPembelian::create($validated);
        }

        return redirect('pembelian')->with('success', 'Input Berhasil');

        // return "Ter-input di Detail Pembelian";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
