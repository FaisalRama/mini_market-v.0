@extends('templates.gentelella')   

@section('title-of-content')
    PEMASOK
@endsection

<!-- Barang -->
@section('content')
<!-- Tambah Data Barang -->
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiPemasok">
            <i> Isi Data!</i>
        </button>

<!-- READ DATA -->
        <table id="tbl-pemasok" class="table table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>Kode Pemasok</th>
                <th>Nama Pemasok</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>No. Telp</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pemasok as $pm)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                <td>{{ $pm->kode_pemasok }}</td>
                <td>{{ $pm->nama_pemasok }}</td>
                <td>{{ $pm->alamat }}</td>
                <td>{{ $pm->kota }}</td>
                <td>{{ $pm->no_telp }}</td>
                <td>
                    <!-- Update Data -->
                    <button class="btn update-pemasok btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiPemasok"
                    data-mode="edit"
                    data-id="{{ $pm->id }}"
                    data-kode_pemasok="{{ $pm->kode_pemasok }}"
                    data-nama_pemasok="{{ $pm->nama_pemasok }}"
                    data-alamat="{{ $pm->alamat }}"
                    data-kota="{{ $pm->kota }}"
                    data-no_telp="{{ $pm->no_telp }}" ><a>UPDATE</a></button>
                    <!-- Delete Data -->
                    <form action="{{ route('pemasok.destroy', $pm->id) }}" method="POST" style="display: inline">
                     @csrf
                    @method('DELETE')
                    <button class="btn delete-pemasok btn-danger" type="button">DELETE</button> &nbsp;
                    </form>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- JSQuery -->
<div>
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

@include('pemasok.modal')
@endsection

<!-- JSQuery -->
@push('script')
<script>
    $(function(){
        // Data Table
        $('#tbl-pemasok').DataTable()

        // Alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        // Delete Alert
        $('.delete-pemasok').click(function(e){
            e.preventDefault()
            let data = $(this).closest('tr').find('td:eq(1)').text()
            swal({
                title: "Apakah Kamu Yakin?", 
                text: "Yakin Ingin Menghapus Data yang anda pilih?",
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
    $('#IsiPemasok').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        console.log(button)
        let id= button.data('id')
        let kode_pemasok= button.data('kode_pemasok')
        let nama_pemasok= button.data('nama_pemasok')
        let alamat= button.data('alamat')
        let kota= button.data('kota')
        let no_telp= button.data('no_telp')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Pemasok')
            modal.find('.modal-body #kode_pemasok').val(kode_pemasok)
            modal.find('.modal-body #nama_pemasok').val(nama_pemasok)
            modal.find('.modal-body #alamat').val(alamat)
            modal.find('.modal-body #kota').val(kota)
            modal.find('.modal-body #no_telp').val(no_telp)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body #method').html('{{ method_field('patch') }}')
            modal.find('.modal-body form').attr('action', 'pemasok/'+id)
        }else{
            modal.find('.modal-title').text('Input Data Pemasok')
            modal.find('.modal-body #kode_pemasok').val('')
            modal.find('.modal-body #nama_pemasok').val('')
            modal.find('.modal-body #alamat').val('')
            modal.find('.modal-body #kota').val('')
            modal.find('.modal-body #no_telp').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })
</script>
@endpush