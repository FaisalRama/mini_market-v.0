<?php

namespace App\Http\Controllers;
        
use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penjualan/index', [
            'penjualan' => Penjualan::all(),
            'barang' => Barang::all(),
            'pelanggan' => Pelanggan::all()
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

        // // pembuatan ID Penjualan
        $d = Penjualan::orderBy('id', 'desc')->first();
        $urutan = ($d == null?1:substr($d->no_faktur, 5, 6)+1);

        $no_faktur = sprintf('P'.date('Y').'%06d', $urutan);
        // // dd($kode_masuk);

        // // Validation / Validasi
        $validated = $request->validate([
            'tgl_faktur' =>'required',
            'total_bayar' =>'required',
            'pelanggan_id' =>'required',
            'barang_id' =>'required',
            'harga_jual' =>'required',
            'jumlah' =>'required',
            'sub_total' =>'required'
        ]);
        $validated['no_faktur'] = $no_faktur;
        $validated['user_id'] = 1;

        // // Input Pembelian
        $input_penjualan = Penjualan::create($validated);
        if($input_penjualan == null) return "data gagal diinput";

        // // Input Detail Pembelian 
        $barang_id = $request->barang_id;
        $harga_jual = $request->harga_jual;
        $jumlah = $request->jumlah;
        $sub_total = $request->sub_total;



        foreach($barang_id as $i => $v){
        //     // echo $barang_id[$i]."|".$harga_beli[$i]."|".$jumlah[$i]."|"
        //     // .$sub_total[$i]."<br>";
            $validated['penjualan_id'] = $input_penjualan->id;
            $validated['barang_id'] = $barang_id[$i];
            $validated['harga_jual'] = $harga_jual[$i];
            $validated['jumlah'] = $jumlah[$i];
            $validated['sub_total'] = $sub_total[$i];
            $input_detail_penjualan = DetailPenjualan::create($validated);
        }

        return redirect('penjualan')->with('success', 'Input Berhasil');

        // // return "Ter-input di Detail Pembelian";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}
