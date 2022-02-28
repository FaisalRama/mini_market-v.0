<!-- Isi Data -->
<div class="modal fade" id="IsiPelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Pelanggan Mu !</h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
              <label for="exampleInputText">Kode Pelanggan : </label>
              <input type="text" class="form-control" id="kode_pelanggan" name="kode_pelanggan" placeholder="Enter Your Buyer Code">
            </div>
            <div class="form-group">
                <label for="exampleInputText">Nama : </label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Your Name" >
              </div>
              <div class="form-group">
                <label for="exampleInputText">Alamat : </label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Your Address">
              </div>
              <div class="form-group">
                <label for="exampleInputText">No. TELP : </label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Enter Your Number Of Your Telephone">
              </div>
              <div class="form-group">
                <label for="exampleInputText">Email : </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
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
  