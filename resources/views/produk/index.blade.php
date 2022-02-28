@extends('templates.gentelella')

@section('title-of-content')
    PRODUCTS
@endsection

@section('content')
<!-- PRODUK -->
<!-- Tambah Data Produk -->

<div class="row">
    <div class="col-md-12 col-sm-12  ">
      <div class="x_panel">
        <div class="x_title">
          <h2>PRODUCTS</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            
          <!-- Content -->

          <!-- Button To Input -->
          <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#IsiProduk">
                    <i> Isi Data!</i>
                </button>
        
        <!-- READ DATA -->
                <table id="tbl-produk" class="table table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($produk as $pr)
                        <tr>
                        <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                        <td>{{ $pr->nama_produk }}</td>
                        <td>
                            <!-- Update Data -->
                            <button class="btn edit-produk btn-success" type="button"
                            data-toggle="modal"
                            data-target="#IsiProduk"
                            data-mode="edit"
                            data-id="{{ $pr->id }}"
                            data-nama_produk="{{ $pr->nama_produk }}" ><a>UPDATE</a></button>
                            <!-- Delete Data -->
                            <form action="{{ route('produk.destroy', $pr->id) }}" method="POST" style="display: inline">
                             @csrf
                            @method('DELETE')
                            <button class="btn delete-produk btn-danger" type="button">DELETE</button> &nbsp;
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        
        <div>

        </div>
      </div>
    </div>
  </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert" id="success-alert">
            {{ session('success') }}
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{  $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<!-- Menghubungkan dengan Modal -->
@include('produk.modal')
@endsection

<!-- JSQuery -->
@push('script')
<script>
    $(function(){
        // Data Table
        $('#tbl-produk').DataTable()

        // Menghapus Alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        // Delete Alert
        $('.delete-produk').click(function(e){
            e.preventDefault()
            let data = $(this).closest('tr').find('td:eq(1)').text()
            swal({
                title: "Apakah Kamu Yakin?", 
                text: "Data " +data+ " Akan Dihapus?",
                icon: "warning",
                buttons:true,
                dangerMode: true,
            })
            .then((req) => {
                if(req) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
    })

    // Edit dan Input Kelas -
    $('#IsiProduk').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        console.log(button)
        let id= button.data('id')
        let nama_produk= button.data('nama_produk')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Produk')
            modal.find('.modal-body #nama_produk').val(nama_produk)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body #method').html('{{ method_field('patch') }}')
            modal.find('.modal-body form').attr('action', 'produk/'+id)
        }else{
            modal.find('.modal-title').text('Input Data Barang')
            modal.find('.modal-body #nama_produk').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })
</script>
@endpush