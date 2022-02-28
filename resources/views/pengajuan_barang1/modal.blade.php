<!-- Isi Data -->
<div class="modal fade" id="IsiPengajuanBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Isi Data Barang Mu !</h5>
        </div>
        <div class="modal-body">
          <!-- Form -->
          <form action="{{ route('pengajuan_barang.store') }}" method="POST">
            @csrf
            <div id="method"></div>
            <div class="form-group">
              <label for="exampleInputText">Nama Pengaju : </label>
              <input type="text" class="form-control" id="nama_pengaju" name="nama_pengaju" placeholder="Enter Your Thing Code">
            </div>
            <div class="form-group">
                <label for="exampleInputText">Nama Barang : </label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Enter Your The ID Of Product" >
              </div>
              <div class="form-group">
                <label for="exampleInputText">Tanggal Pengajuan : </label>
                <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" placeholder="Enter Your Thing Name">
              </div>
              <div class="form-group">
                <label for="exampleInputText">QTY : </label>
                <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Your Unit">
              </div>
              {{-- <div class="form-group">
                <label for="exampleInputText">Tarik : </label>
                <input type="text" class="form-control" id="ditarik" name="ditarik" placeholder="Choose 0 or 1">
              </div> --}}
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  