@extends('layout.main')
@section('title', 'Detail Pelajaran')
@section('content')
<div class="row">

    <x-card-box cardTitle="Detail Pelajaran">

        <div class="row">
            <div class="col-lg-4 col-sm-12 mb-4">
                <a href="{{ route('data-pelajaran') }}">
                    <div class="alert alert-outline-primary">
                        <span>&larr; Kembali ke Data Pelajaran</span>
                    </div>
                </a>
            </div>

            <div class="col-lg-8 col-sm-12">
                <form action="{{ route('edit-pelajaran') }}" method="POST" class="form-pelajaran">
                    @csrf
                    <input type="text" name="id" value="{{ $pelajaran_target->id }}" hidden>

                    <div class="alert alert-light-warning">
                        <span>Detail dan Deskripsi</span>
                    </div>

                    <div class="mb-3">
                        <label for="nama">Nama Pelajaran</label>
                        <input type="text" value="{{ $pelajaran_target->nama }}" id="nama" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi Pelajaran</label>
                        <input type="text" value="{{ $pelajaran_target->deskripsi }}" id="deskripsi" name="deskripsi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="d-block"> Status Pelajaran</label>
                        <label class="switch s-primary mr-2">
                            <input type="checkbox" {{ ($pelajaran_target->is_active) ? 'checked' : '' }} class="activate" data-id="{{ $pelajaran_target->id }}" data-nama="{{ $pelajaran_target->nama }}">
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary simpan-pelajaran">Simpan</button>
                    </div>

                </form>
            </div>
        </div>

    </x-card-box>

</div>

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/forms/switches.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<x-sweet-alert />

<script>
    const simpanTrigger = document.querySelector('.simpan-pelajaran')
    $(document).ready(function() {

        $(document).on('click', '.activate', function(e) {
            let is_checked = $(this).prop('checked')
            let id = $(this).attr('data-id')
            let nama = $(this).attr('data-nama')
            activatePelajaran(id, is_checked, nama)
        })

        const submitSimpanPelajaranBtn = document.querySelector('button[type="submit"].simpan-pelajaran')
        submitSimpanPelajaranBtn.addEventListener('click', () => {
            const spinner = document.createElement('div')
            spinner.classList = "spinner-border text-white align-self-center loader-sm"
            submitSimpanPelajaranBtn.replaceChild(spinner, submitSimpanPelajaranBtn.childNodes[0])
        })
    })

    $('form.form-pelajaran').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()
        serrialAssoc(data)
    })

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        })
        prosesAjax(formData, "{{ route('edit-pelajaran') }}")
    }

    function activatePelajaran(id, is_checked, nama) {

        let formData = new FormData
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('id', id)
        formData.append('is_active', is_checked)
        formData.append('nama', nama)
        prosesAjax(formData, "{{ route('activate-pelajaran') }}")
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

    function onfinish() {
        let span = document.createElement('span')
        span.innerHTML = 'Simpan'
        simpanTrigger.replaceChild(span, simpanTrigger.childNodes[0])
    }

</script>
@endsection
