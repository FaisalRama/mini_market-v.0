@extends('templates.gentelella')    

@section('title-of-content')
    PELANGGAN
@endsection

<!-- Barang -->
@section('content')
<!-- Tambah Data Barang -->
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiPelanggan">
            <i> Isi Data!</i>
        </button>

<!-- READ DATA -->
        <table id="tbl-pelanggan" class="table table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>Kode Pelanggan</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pelanggan as $pl)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                <td>{{ $pl->kode_pelanggan }}</td>
                <td>{{ $pl->nama }}</td>
                <td>{{ $pl->alamat }}</td>
                <td>{{ $pl->no_telp }}</td>
                <td>{{ $pl->email }}</td>
                <td>
                    <!-- Update Data -->
                    <button class="btn update-pelanggan btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiPelanggan"
                    data-mode="edit"
                    data-id="{{ $pl->id }}"
                    data-kode_pelanggan="{{ $pl->kode_pelanggan }}"
                    data-nama="{{ $pl->nama }}"
                    data-alamat="{{ $pl->alamat }}"
                    data-no_telp="{{ $pl->no_telp }}"
                    data-email="{{ $pl->email }}" ><a>UPDATE</a></button>
                    <!-- Delete Data -->
                    <form action="{{ route('pelanggan.destroy', $pl->id) }}" method="POST" style="display: inline">
                     @csrf
                    @method('DELETE')
                    <button class="btn delete-pelanggan btn-danger" type="button">DELETE</button> &nbsp;
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

@include('pelanggan.modal')
@endsection

<!-- JSQuery -->
@push('script')
<script>
    $(function(){
        // Data Table
        $('#tbl-pelanggan').DataTable()

        // Alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        // Delete Alert
        $('.delete-pelanggan').click(function(e){
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
    $('#IsiPelanggan').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        console.log(button)
        let id= button.data('id')
        let kode_pelanggan= button.data('kode_pelanggan')
        let nama= button.data('nama')
        let alamat= button.data('alamat')
        let no_telp= button.data('no_telp')
        let email= button.data('email')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Pelanggan')
            modal.find('.modal-body #kode_pelanggan').val(kode_pelanggan)
            modal.find('.modal-body #nama').val(nama)
            modal.find('.modal-body #alamat').val(alamat)
            modal.find('.modal-body #no_telp').val(no_telp)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body #method').html('{{ method_field('patch') }}')
            modal.find('.modal-body form').attr('action', 'pelanggan/'+id)
        }else{
            modal.find('.modal-title').text('Input Data Pelanggan')
            modal.find('.modal-body #kode_pelanggan').val('')
            modal.find('.modal-body #nama').val('')
            modal.find('.modal-body #alamat').val('')
            modal.find('.modal-body #no_telp').val('')
            modal.find('.modal-body #email').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })
</script>
@endpush