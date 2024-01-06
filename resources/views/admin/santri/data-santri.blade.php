@extends('layout.main')
@section('title', 'Data Santri')
@section('content')
<div class="row">

    <x-card-box cardTitle="Data Santri">

        <div class="row mb-3">
            <div class="col mx-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-sm"><i data-feather="share-2" class="mr-2"></i> Export</button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahSantriModal"><i data-feather="user-plus" class="mr-2"></i> Tambah</button>
                </div>
            </div>
        </div>

        <x-datatable-responsive tableId="data-santri">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Tahun Masuk</th>
                    <th>Status</th>
                    <th><i data-feather="more-horizontal"></i></th>
                </tr>
            </thead>
        </x-datatable-responsive>

    </x-card-box>

    {{-- modal --}}
    <x-modal-tambah-santri />


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
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<x-sweet-alert />
<script>
    $(document).ready(function() {
        loadData()
        $("#tanggal_lahir").inputmask("99/99/9999");

        $(document).on('click', '.hapus-data', function(e) {
            e.preventDefault()
            let id = $(this).attr('data-id')
            let nama = $(this).attr('data-nama')
            deleteSantri(id, nama)
        })

        $(document).on('click', '.activate', function(e) {
            let is_checked = $(this).prop('checked')
            let id = $(this).attr('data-id')
            let nama = $(this).attr('data-nama')
            activateSantri(id, is_checked, nama)
        })

    })

    function loadData() {
        $('#data-santri').DataTable({
            processing: true, //
            pagination: true, //
            serverSide: true, //
            searching: true, //
            ajax: {
                url: "{{ route('data-santri') }}", //
            }, //
            columns: [{
                    data: 'DT_RowIndex', //
                    name: 'DT_RowIndex', //
                    orderable: false, //
                    searchbar: false, //
                    className: 'text-center'
                }, //
                {
                    data: 'foto', //
                    orderable: false, //
                }, //
                {
                    data: 'nama'
                }, //
                {
                    data: 'nis'
                }, //
                {
                    data: 'tahun_masuk', //
                    className: 'text-center'
                }, //
                {
                    data: 'status'
                }, //
                {
                    data: 'more', //
                    orderable: false, //
                }, //
            ]
        })
    }

    $("form.tambah-santri").on("submit", function(event) {
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
        prosesAjax(formData, "{{ route('tambah-santri') }}")
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
            document.querySelector("form.tambah-santri").reset();
            $('#tambahSantriModal').modal('hide')
            $('#data-santri').DataTable().ajax.reload()
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
        onfinish()
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

    function deleteSantri(id, nama) {
        swal({
            type: 'warning', //
            title: 'Hapus Santri', //
            html: `Menghapus Santri ${nama}?`, //
            showCancelButton: true, //
            confirmButtonText: 'Hapus', //
        }).then((result) => {
            if (result.value) {
                let formData = new FormData()
                formData.append('_token', "{{ csrf_token() }}")
                formData.append('id', id)
                formData.append('nama', nama)
                prosesAjax(formData, "{{ route('hapus-santri') }}")
            }
        })
    }

    function activateSantri(id, is_checked, nama) {

        let formData = new FormData
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('id', id)
        formData.append('is_active', is_checked)
        formData.append('nama', nama)
        prosesAjax(formData, "{{ route('activate-santri') }}")
    }

</script>

@endsection
