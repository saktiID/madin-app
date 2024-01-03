@extends('layout.main')
@section('title', 'Data Pelajaran')
@section('content')
<div class="row">

    <x-card-box cardTitle="Data Pelajaran">

        <div class="row mb-3">
            <div class="col mx-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-sm"><i data-feather="share-2" class="mr-2"></i> Export</button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahPelajaranModal"><i data-feather="file-plus" class="mr-2"></i> Tambah</button>
                </div>
            </div>
        </div>

        <x-datatable-responsive tableId="data-pelajaran">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Pelajaran</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th><i data-feather="more-horizontal"></i></th>
                </tr>
            </thead>
        </x-datatable-responsive>

    </x-card-box>

    {{-- modal --}}
    <x-modal-tambah-pelajaran />

</div>
@endsection


@section('style')
<link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/forms/switches.css') }}">
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
            deletePelajran(id, nama)
        })

        $(document).on('click', '.activate', function(e) {
            let is_checked = $(this).prop('checked')
            let id = $(this).attr('data-id')
            let nama = $(this).attr('data-nama')
            activatePelajaran(id, is_checked, nama)
        })
    })

    function loadData() {
        $('#data-pelajaran').DataTable({
            processing: true, //
            pagination: true, //
            serverSide: true, //
            searching: true, //
            ajax: {
                url: "{{ route('data-pelajaran') }}", //
            }, //
            columns: [{
                    data: 'DT_RowIndex', //
                    name: 'DT_RowIndex', //
                    orderable: false, //
                    searchbar: false, //
                    className: 'text-center'
                }, //
                {
                    data: 'nama_pelajaran'
                }, //
                {
                    data: 'deskripsi'
                }, //
                {
                    data: 'is_active'
                }, //
                {
                    data: 'more', //
                    orderable: false, //
                }, //
            ]
        })
    }

    $("form.tambah-pelajaran").on("submit", function(event) {
        event.preventDefault()
        let data = $(this).serializeArray()
        serrialAssoc(data)
        onload()
    })

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        })
        prosesAjax(formData, "{{ route('tambah-pelajaran') }}")
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
            document.querySelector("form.tambah-pelajaran").reset();
            $('#tambahPelajaranModal').modal('hide')
            $('#data-pelajaran').DataTable().ajax.reload()
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

    function deletePelajran(id, nama) {
        swal({
            type: 'warning', //
            title: 'Hapus Pelajaran', //
            html: `Menghapus pelajaran ${nama}?`, //
            showCancelButton: true, //
            confirmButtonText: 'Hapus', //
        }).then((result) => {
            if (result.value) {
                let formData = new FormData()
                formData.append('_token', "{{ csrf_token() }}")
                formData.append('id', id)
                formData.append('nama_pelajaran', nama)
                prosesAjax(formData, "{{ route('hapus-pelajaran') }}")
            }
        })
    }

    function activatePelajaran(id, is_checked, nama) {

        let formData = new FormData
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('id', id)
        formData.append('is_active', is_checked)
        formData.append('nama', nama)
        prosesAjax(formData, "{{ route('activate-pelajaran') }}")
    }

</script>
@endsection
