<!-- Isi Data -->
<div class="modal fade" id="IsiPemasok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Pemasok Mu !</h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form action="{{ route('pemasok.store') }}" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
              <label for="exampleInputText">Kode Pemasok : </label>
              <input type="text" class="form-control" id="kode_pemasok" name="kode_pemasok" placeholder="Enter Your Pemasok Code">
            </div>
            <div class="form-group">
                <label for="exampleInputText">Nama Pemasok : </label>
                <input type="text" class="form-control" id="nama_pemasok" name="nama_pemasok" placeholder="Enter Your Pemasok Name" >
              </div>
              <div class="form-group">
                <label for="exampleInputText">Alamat : </label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Your Address">
              </div>
              <div class="form-group">
                <label for="exampleInputText">Kota : </label>
                <input type="text" class="form-control" id="kota" name="kota" placeholder="Enter Your City">
              </div>
              <div class="form-group">
                <label for="exampleInputText">No. Telp: </label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Enter Your Number Of Your Telephone">
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
  