<!-- Isi Data -->
<div class="modal fade" id="IsiBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Barang Mu !</h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
              <label for="exampleInputText">Kode Barang : </label>
              <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Enter Your Thing Code">
            </div>
            <div class="form-group">
                <label for="exampleInputText">Produk ID : </label>
                <input type="text" class="form-control" id="produk_id" name="produk_id" placeholder="Enter Your The ID Of Product" >
              </div>
              <div class="form-group">
                <label for="exampleInputText">Nama Barang : </label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Enter Your Thing Name">
              </div>
              <div class="form-group">
                <label for="exampleInputText">Satuan : </label>
                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Enter Your Unit">
              </div>
              <div class="form-group">
                <label for="exampleInputText">Harga Jual : </label>
                <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Enter Your Price">
              </div>
              <div class="form-group">
                <label for="exampleInputText">Stok : </label>
                <input type="text" class="form-control" id="stok" name="stok" placeholder="Enter Your Stock">
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  