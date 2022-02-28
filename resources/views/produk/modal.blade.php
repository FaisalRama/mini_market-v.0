<!-- Isi Data -->
<div class="modal fade" id="IsiProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Isi Data Produk Mu !</h5>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form action="{{ route('produk.store') }}" method="POST">
          @csrf
          <div id="method"></div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Produk : </label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Enter Your Product Name">
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
