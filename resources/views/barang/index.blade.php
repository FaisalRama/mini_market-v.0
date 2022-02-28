@extends('templates.gentelella')    

@section('title-of-content')
    BARANG
@endsection

<!-- Barang -->
@section('content')
<!-- Tambah Data Barang -->
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiBarang">
            <i> Isi Data!</i>
        </button>

<!-- READ DATA -->
        <table id="tbl-barang" class="table table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Produk ID</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Tarik</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($barang as $br)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                <td>{{ $br->kode_barang }}</td>
                <td>{{ $br->produk_id }}</td>
                <td>{{ $br->nama_barang }}</td>
                <td>{{ $br->satuan }}</td>
                <td>{{ $br->harga_jual }}</td>
                <td>{{ $br->stok }}</td>
                <td>
                    <label>
                    <input type="checkbox" class="ditarik js-switch" {{ $cek = ($br->ditarik==1?"checked":"") }}>
                    </label>
                </td>
                <td>
                    <!-- Update Data -->
                    <button class="btn edit-barang btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiBarang"
                    data-mode="edit"
                    data-id="{{ $br->id }}"
                    data-kode_barang="{{ $br->kode_barang }}"
                    data-produk_id="{{ $br->produk_id }}"
                    data-nama_barang="{{ $br->nama_barang }}"
                    data-satuan="{{ $br->satuan }}"
                    data-harga_jual="{{ $br->harga_jual }}"
                    data-stok="{{ $br->stok }}" ><a>UPDATE</a></button>
                    
                    <!-- Delete Data -->
                    <form action="{{ route('barang.destroy', $br->id) }}" method="POST" style="display: inline">
                     @csrf
                    @method('DELETE')
                    <button class="btn delete-barang btn-danger" type="button">DELETE</button> &nbsp;
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

@include('barang.modal')
@endsection

<!-- JSQuery -->
@push('script')
<script>
    $(function(){
        // Data Table
        $('#tbl-barang').DataTable()

        // Alert
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
            $("success-alert").slideUp(500);
        });

        // Delete Alert
        $('.delete-barang').click(function(e){
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
    $('#IsiBarang').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        console.log(button)
        let id= button.data('id')
        let kode_barang= button.data('kode_barang')
        let produk_id= button.data('produk_id')
        let nama_barang= button.data('nama_barang')
        let satuan= button.data('satuan')
        let harga_jual= button.data('harga_jual')
        let stok= button.data('stok')
        let ditarik= button.data('ditarik')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Barang')
            modal.find('.modal-body #kode_barang').val(kode_barang)
            modal.find('.modal-body #produk_id').val(produk_id)
            modal.find('.modal-body #nama_barang').val(nama_barang)
            modal.find('.modal-body #satuan').val(satuan)
            modal.find('.modal-body #harga_jual').val(harga_jual)
            modal.find('.modal-body #stok').val(stok)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body #method').html('{{ method_field('patch') }}')
            modal.find('.modal-body form').attr('action', 'barang/'+id)
        }else{
            modal.find('.modal-title').text('Input Data Barang')
            modal.find('.modal-body #kode_barang').val('')
            modal.find('.modal-body #produk_id').val('')
            modal.find('.modal-body #nama_barang').val('')
            modal.find('.modal-body #satuan').val('')
            modal.find('.modal-body #harga_jual').val('')
            modal.find('.modal-body #stok').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })

    $('#tbl-barang').on('click','.ditarik', function(){
        let kode_barang = $(this).closest('tr').find('td:eq(1)').text()
        let checked = ($(this).closest('tr').find('.ditarik').is(':checked')?1:0)
        let data = {
            kode_barang:kode_barang,
            ditarik : checked,
            _token: "{{ csrf_token() }}"
                    };
        $.post('{{ route("ditarik") }}', data, function(msg){
            alert('msg')
        })
        // alert(checked)
    })
</script>
@endpush