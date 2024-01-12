@extends('layout.main')
@section('title', 'Data Periode')
@section('content')
<div class="row">

    <x-card-box cardTitle="Data Periode">

        <div class="row mb-3">
            <div class="col mx-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahPeriodeModal"><i data-feather="file-plus" class="mr-2"></i> Tambah</button>
                </div>
            </div>
        </div>

        <x-datatable-responsive tableId="data-periode">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                </tr>
            </thead>
        </x-datatable-responsive>

    </x-card-box>

    {{-- modal --}}
    <x-modal-tambah-periode />

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

    })

    $('#tambahPeriodeModal').on('shown.bs.modal', function() {
        const display_kode_konfirmasi = document.getElementById('display_kode_konfirmasi')
        const kunci_kode_konfirmasi = document.getElementById('kunci_kode_konfirmasi')
        const kode = makeCode(6)

        display_kode_konfirmasi.innerHTML = kode
        kunci_kode_konfirmasi.value = kode
    })

    $("form.tambah-periode").on("submit", function(event) {
        event.preventDefault()
        let data = $(this).serializeArray()
        serrialAssoc(data)
        onload()
    })

    function makeCode(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
        }
        return result;
    }

    function loadData() {
        $('#data-periode').DataTable({
            processing: true, //
            pagination: true, //
            serverSide: true, //
            searching: true, //
            order: [
                [2, 'asc']
            ], //
            ajax: {
                url: "{{ route('data-periode') }}", //
            }, //
            oLanguage: {
                sProcessing: "<div class='spinner-border text-primary align-self-center loader-sm'></div>"
            }, //
            columns: [{
                    data: 'id', //
                    className: 'text-center', //
                    orderable: false, //
                }, //
                {
                    data: 'semester', //
                    className: 'text-center', //
                    orderable: false, //
                }, //
                {
                    data: 'tahun_ajaran', //
                    className: 'text-center', //
                }, //
                {
                    data: 'more', //
                    orderable: false, //
                }, //
            ]
        })
    }

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        })
        prosesAjax(formData, "{{ route('tambah-periode') }}")
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
            document.querySelector("form.tambah-periode").reset();
            $('#tambahPeriodeModal').modal('hide')
            $('#data-periode').DataTable().ajax.reload()
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

</script>


@endsection
