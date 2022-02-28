@extends('templates.gentelella')    

@section('title-of-content')
    PENGAJUAN BARANG
@endsection

<!-- Barang -->
@section('content')
<!-- Tambah Data Barang -->
<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#IsiPengajuanBarang">
            <i> Ajukan Barang !</i>
        </button>

<!-- READ DATA -->
        <table id="tbl-barang" class="table table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pengaju</th>
                <th>Nama Barang</th>
                <th>Tanggal Pinjaman</th>
                <th>QTY</th>
                <th>Terpenuhi?</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pengajuan_barang1 as $br)
                <tr>
                <td>{{ $i = (isset($i)?++$i:$i=1) }}</td>
                <td>{{ $br->nama_pengaju }}</td>
                <td>{{ $br->nama_barang }}</td>
                <td>{{ $br->tanggal_pengajuan }}</td>
                <td>{{ $br->qty }}</td>
                <td>
                    <label>
                    <input type="checkbox" class="ditarik js-switch" {{ $cek = ($br->ditarik==1?"checked":"") }}>
                    </label>
                </td>
                <td>
                    <!-- Update Data -->
                    <button class="btn edit-barang btn-success" type="button"
                    data-toggle="modal"
                    data-target="#IsiPengajuanBarang"
                    data-mode="edit"
                    data-id="{{ $br->id }}"
                    data-nama_pengaju="{{ $br->nama_pengaju }}"
                    data-nama_barang="{{ $br->nama_barang }}"
                    data-tanggal_pengajuan="{{ $br->tanggal_pengajuan }}"
                    data-qty="{{ $br->qty }}" ><a>UPDATE</a></button>
                    
                    <!-- Delete Data -->
                    <form action="{{ route('pengajuan_barang.destroy', $br->id) }}" method="POST" style="display: inline">
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

@include('pengajuan_barang1.modal')
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
    $('#IsiPengajuanBarang').on('show.bs.modal', function(event){
        let button = $(event.relatedTarget)
        console.log(button)
        let id= button.data('id')
        let nama_pengaju= button.data('nama_pengaju')
        let nama_barang= button.data('nama_barang')
        let tanggal_pengajuan= button.data('tanggal_pengajuan')
        let qty= button.data('qty')
        // let ditarik= button.data('ditarik')
        let mode= button.data('mode')
        let modal= $(this)
        if(mode === "edit"){
            modal.find('.modal-title').text('Edit Data Barang')
            modal.find('.modal-body #nama_pengaju').val(nama_pengaju)
            modal.find('.modal-body #nama_barang').val(nama_barang)
            modal.find('.modal-body #tanggal_pengajuan').val(tanggal_pengajuan)
            modal.find('.modal-body #qty').val(qty)
            // modal.find('.modal-body #ditarik').val(ditarik)
            modal.find('.modal-footer #btn-submit').text('Update')
            modal.find('.modal-body #method').html('{{ method_field('patch') }}')
            modal.find('.modal-body form').attr('action', 'pengajuan_barang/'+id)
        }else{
            modal.find('.modal-title').text('Input Data Barang')
            modal.find('.modal-body #nama_pengaju').val('')
            modal.find('.modal-body #nama_barang').val('')
            modal.find('.modal-body #tanggal_pengajuan').val('')
            modal.find('.modal-body #qty').val('')
            // modal.find('.modal-body #ditarik').val('')
            modal.find('.modal-body #method').html("")
            modal.find('.modal-footer #btn-submit').text('Submit')
        }
    })

    $('#tbl-barang').on('click','.ditarik', function(){
        let nama_pengaju = $(this).closest('tr').find('td:eq(1)').text()
        let checked = ($(this).closest('tr').find('.ditarik').is(':checked')?1:0)
        let data = {
            nama_pengaju:nama_pengaju,
            ditarik : checked,
            _token: "{{ csrf_token() }}"
                    };
        $.post('{{ route("ditarik") }}', data, function(msg){
            alert('Data Ter Switch !')
        })
        // alert(checked)
    })
</script>
@endpush