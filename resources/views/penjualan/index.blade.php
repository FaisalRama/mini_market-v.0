@extends('templates.gentelella')

<!-- Title 1 -->
@section('title-of-content')
    TRANSAKSI PENJUALAN
@endsection

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{  $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<!-- Title 2 -->
<form id="FormTrx" method="post" action="penjualan">
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2> DETAIL PEMASOK DAN DETAIL PENJUALAN </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
@include('penjualan.modal')

<!-- Form Atas -->

@csrf
<div class="row">
    <div class="col-md-6 form-group">
        <label for="" class="col-md-4">Tanggal Penjualan</label>
        <div class="col-md-8">
            <input type="date" class="form-control" name="tgl_faktur" 
            required="required" value="{{ date('Y-m-d') }}">
        </div>
    </div>
    <div class="col-md-6 form-group">
        <label for="" class="col-md-4">Pelanggan</label>
        <div class="col-md-8">
            <select name="pelanggan_id" required="required" class="form-control">
                @foreach ($pelanggan as $plgn)
                    <option value="{{ $plgn->id }}">{{ $plgn->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    &nbsp;
    <div class="col-md-6 form-group">
        <button id="UntukPilihBarang" type="button" class="btn btn-dark " data-toggle="modal" data-target="#PilihBarang">
            <i> Pilih Data Barang! </i>
        </button>
    </div>
</div>
</div>
<!-- end form atas -->

<!-- tabel sementara barang -->
<div>
    <h3>Barang Yang Antum Pilih</h3>
    <table id="tbl-Transaksi" class="table table-striped table-bordered bulk-action">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>QTY</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6" style="text-align:center;font-style:italic">Belum Ada Data!</td>
            </tr>
        </tbody>
    </table>
</div>




            </div>
        </div>
    </div>
</div>
<!-- end tabel sementara barang -->

<!-- Modal Simpan TRX -->
<div class="row" style="text-align: right; margin-bottom: 10px">
    <div class="col-md-12">
        <div class="col-md-12" style="text-align: right">
            <label class="control-label col-md-3">Total Harga</label>
            <div class="col-md-3" style="text-align: right; margin-right: 0; padding-right: 0">
            <input type="text" class="form-control col-md-6" required="required" name="total_bayar" id="totalHarga" readonly>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="text-align: right; margin-right: 0; padding-right: 0">
        <div class="col-md-12">
            <button class="btn btn-dark" type="submit"> Save The Transaction </button>            
        </div>
    </div>
</div>
</form>
<!-- End Modal Simpan TRX -->

@include('penjualan.data')
@endsection