@extends('layout.main')
@section('title', 'Data Kelas')
@section('content')
<div class="row">

    <x-card-box cardTitle="Data Kelas">

        <div class="row mb-3">
            <div class="col mx-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahKelasModal"><i data-feather="file-plus" class="mr-2"></i> Tambah</button>
                </div>
            </div>
        </div>

        <x-datatable-responsive tableId="data-kelas">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Jenjang</th>
                    <th>Kelas</th>
                    <th>Bagian</th>
                    <th><i data-feather="more-horizontal"></i></th>
                </tr>
            </thead>
        </x-datatable-responsive>

    </x-card-box>

    {{-- modal --}}
    <x-modal-tambah-kelas periodeId="{{ $currentPeriode['id'] }}" semester="{{ $currentPeriode['semester'] }}" tahun="{{ $currentPeriode['tahun_ajaran'] }}" />

</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<x-sweet-alert />

<script>
    $(document).ready(function() {
        loadData()

        $(document).on('click', '.hapus-data', function(e) {
            e.preventDefault()
            let id = $(this).attr('data-id')
            let nama = $(this).attr('data-nama')
            deleteKelas(id, nama)
        })
    })

    function loadData() {
        $('#data-kelas').DataTable({
            processing: true, //
            pagination: true, //
            serverSide: true, //
            searching: true, //
            ajax: {
                url: "{{ route('data-kelas') }}", //
            }, //
            columns: [{
                    data: 'DT_RowIndex', //
                    name: 'DT_RowIndex', //
                    orderable: false, //
                    searchbar: false, //
                    className: 'text-center'
                }, //
                {
                    data: 'jenjang_kelas', ///
                    className: 'text-center'
                }, //
                {
                    data: 'nama_kelas'
                }, //
                {
                    data: 'bagian_kelas', //
                    className: 'text-center'
                }, //
                {
                    data: 'more'
                }, //
            ]
        })
    }

    $('form.tambah-kelas').on('submit', function(e) {
        e.preventDefault();
        let data = $(this).serializeArray()
        serrialAssoc(data)
        onload()
    })

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        })
        prosesAjax(formData, "{{ route('tambah-kelas') }}")
    }

    function prosesAjax(data, route) {
        $.ajax({
            url: route, //
            method: 'POST', //
            data: data, //
            dataType: 'json', //
            processData: false, //
            contentType: false, //
            success: function(res) {
                feedback(res)
            }, //
            error: function(err) {
                console.log(err.responseText)
                errorClientSide(err.responseText)
            }
        });
    }

    function feedback(res) {
        if (!res.status) {
            const divError = document.createElement('div')
            for (let key in res.data) {
                res.data[key].forEach((e) => {
                    let span = document.createElement('span')
                    span.innerHTML = e + '<br>'
                    divError.appendChild(span)
                })
            }
            let data = {
                icon: 'error', //
                title: 'Oops!', //
                html: divError
            }
            sweetAlert(data)
            onfinish()
        } else {
            sweetAlert(res.data)
            document.querySelector("form.tambah-kelas").reset();
            $('#tambahKelasModal').modal('hide')
            $('#data-kelas').DataTable().ajax.reload()
            onfinish()
        }
    }

    function errorClientSide(err) {
        let data = {
            icon: 'error', //
            title: 'Oops!', //
            html: err
        }
        sweetAlert(data)
    }

    function onload() {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        tambahTrigger.replaceChild(spinner, tambahTrigger.childNodes[0])
    }

    function onfinish() {
        let span = document.createElement('span')
        span.innerHTML = 'Tambah'
        tambahTrigger.replaceChild(span, tambahTrigger.childNodes[0])
    }

    function deleteKelas(id, nama) {
        swal({
            type: 'warning', //
            title: 'Hapus Kelas', //
            html: `Menghapus kelas ${nama}?`, //
            showCancelButton: true, //
            confirmButtonText: 'Hapus', //
        }).then((result) => {
            if (result.value) {
                let formData = new FormData()
                formData.append('_token', "{{ csrf_token() }}")
                formData.append('id', id)
                formData.append('nama_pelajaran', nama)
                prosesAjax(formData, "{{ route('hapus-kelas') }}")
            }
        })
    }

    @if(session('response'))
    let data = @json(session('response'));
    sweetAlert(data)
    @endif

</script>

@endsection
