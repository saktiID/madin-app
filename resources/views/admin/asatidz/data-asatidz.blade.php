@extends('layout.main')
@section('title', 'Data Asatidz')
@section('content')
<div class="row">

    <x-card-box cardTitle="Data Asatidz">

        <div class="row mb-3">
            <div class="col mx-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-sm"><i data-feather="share-2" class="mr-2"></i> Export</button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahAsatidzModal"><i data-feather="user-plus" class="mr-2"></i> Tambah</button>
                </div>
            </div>
        </div>

        <x-datatable-responsive tableId="data-asatidz">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th><i data-feather="more-horizontal"></i></th>
                </tr>
            </thead>
        </x-datatable-responsive>


    </x-card-box>



    {{-- modal --}}
    <x-modal-tambah-asatidz />



</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
@endsection


@section('script')
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<x-sweet-alert />
<script>
    $(document).ready(function() {
        loadData()
        $("#tanggal_lahir_asatidz").inputmask("99/99/9999");

        $(document).on('click', '.hapus-data', function(e) {
            e.preventDefault()
            let id = $(this).attr('data-id')
            let nama = $(this).attr('data-nama')
            deleteAsatidz(id, nama)
        })
    });

    function loadData() {
        $('#data-asatidz').DataTable({
            processing: true, //
            pagination: true, //
            serverSide: true, //
            searching: true, //
            ajax: {
                url: "{{ route('data-asatidz') }}", //
            }, //
            columns: [{
                    data: 'DT_RowIndex', //
                    name: 'DT_RowIndex', //
                    orderable: false, //
                    searchbar: false, //
                    className: 'text-center'
                }, //
                {
                    data: 'foto'
                }, //
                {
                    data: 'nama'
                }, //
                {
                    data: 'email'
                }, //
                {
                    data: 'telp'
                }, //
                {
                    data: 'more'
                }, //
            ]
        })
    }

    $("form.tambah-asatidz").on("submit", function(event) {
        event.preventDefault()
        let data = $(this).serializeArray()
        serrialAssoc(data)
        onload()
    })

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        });
        prosesAjax(formData, "{{ route('tambah-asatidz') }}")
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
            document.querySelector("form.tambah-asatidz").reset();
            $('#tambahAsatidzModal').modal('hide')
            $('#data-asatidz').DataTable().ajax.reload()
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

    function deleteAsatidz(id, nama) {
        swal({
            type: 'warning', //
            title: 'Hapus Asatidz', //
            html: `Menghapus Asatidz ${nama}?`, //
            showCancelButton: true, //
            confirmButtonText: 'Hapus', //
        }).then((result) => {
            if (result.value) {
                let formData = new FormData()
                formData.append('_token', "{{ csrf_token() }}")
                formData.append('id', id)
                formData.append('nama', nama)
                prosesAjax(formData, "{{ route('hapus-asatidz') }}")
            }
        })
    }

</script>

@endsection
