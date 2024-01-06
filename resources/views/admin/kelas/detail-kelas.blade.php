@extends('layout.main')
@section('title', 'Detail Kelas')
@section('content')
<div class="row">

    <x-card-box cardTitle="Detail Kelas">
        <div class="row">
            <div class="col-lg-4 col-sm-12 mb-4">
                <a href="{{ route('data-kelas') }}">
                    <div class="alert alert-outline-primary">
                        <span>&larr; Kembali ke Data Kelas</span>
                    </div>
                </a>

                <label for="mustahiq_id">Mustahiq Kelas <i>(Walikelas)</i></label>
                <div class="d-flex justify-content-center">
                    <div class="avatar avatar-xl ">
                        <div class="rounded alert alert-light-danger p-0 " style="height: 170px; width:170px">
                            @if (isset($mustahiq))
                            <img id="foto" src="{{ route('get-foto', ['filename' => $mustahiq->avatar]) }}" class="rounded" width="170px" height="170px">
                            @else
                            <img id="foto" src="" class="rounded" width="170px" height="170px">
                            @endif
                        </div>
                    </div>
                </div>
                <select name="mustahiq_id" id="mustahiq_id" class="form-control" required>
                    <option value="">-- Pilih Mustahiq --</option>
                </select>
            </div>

            <div class="col-lg-8 col-sm-12">
                <form action="#" method="POST" class="form-kelas">
                    <div class="alert alert-light-warning">
                        <span>Detail Kelas</span>
                    </div>
                    <div class="mb-3">
                        <label for="mustahiq_saat_id">Mustahiq saat ini</label>
                        @if(isset($mustahiq))
                        <input type="text" value="{{ $mustahiq->nama }}" id="mustahiq_saat_id" class="form-control" readonly required>
                        @else
                        <input type="text" value="" id="mustahiq_saat_id" class="form-control" readonly required>
                        @endif
                    </div>

                    @csrf
                    <input type="text" name="kelas_id" value="{{ $kelas->id }}" hidden>

                    <div class="mb-3">
                        <label for="jenjang_kelas">Jenjang</label>
                        <select name="jenjang_kelas" id="jenjang_kelas" class="form-control" required>
                            <option value="">-- Pilih Jenjang --</option>
                            @for($i = 1; $i < 13; $i++) <option value="{{ $i }}" {{ ($kelas->jenjang_kelas == $i) ? 'selected' : '' }}>Jenjang - {{ $i }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" value="{{ $kelas->nama_kelas }}" id="nama_kelas" name="nama_kelas" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="bagian_kelas">Bagian Kelas</label>
                        <input type="text" value="{{ $kelas->bagian_kelas }}" id="bagian_kelas" name="bagian_kelas" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary simpan-kelas">Simpan</button>
                    </div>

                </form>

            </div>
        </div>

    </x-card-box>

    <x-card-box cardTitle="Santri Kelas">

        <div class="row mb-3">
            <div class="col mx-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-info btn-sm">
                        <i data-feather="share-2" class="mr-2"></i> Export</button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#masukkanSantriModal">
                        <i data-feather="corner-down-right" class="mr-2"></i> Masukkan santri ke kelas</button>
                </div>
            </div>
        </div>

        <x-datatable-responsive tableId="santri-kelas">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th><i data-feather="more-horizontal"></i></th>
                </tr>
            </thead>
        </x-datatable-responsive>

    </x-card-box>

    {{-- modal --}}
    <x-modal-santri-masuk-kelas kelasId="{{ $kelas->id }}" />


</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<x-sweet-alert />

<script>
    $(document).ready(function() {
        loadData()
        populateSelectAsatidz()
    })
    const wrapperSantri = document.querySelector('.wrapper-santri')
    const submitSimpanKelasBtn = document.querySelector('button[type="submit"].simpan-kelas')
    submitSimpanKelasBtn.addEventListener('click', () => {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        submitSimpanKelasBtn.replaceChild(spinner, submitSimpanKelasBtn.childNodes[0])
    })

    $('#mustahiq_id').on('change', function(e) {
        let val = this.value
        let ex = val.split('/')
        let formData = new FormData()
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('mustahiq_id', ex[0])
        formData.append('nama_mustahiq', ex[2])
        formData.append('kelas_id', "{{ $kelas->id }}")
        prosesAjax(formData, "{{ route('set-mustahiq-kelas') }}")
        replaceImg(ex[1])
        replaceNamaMustahiq(ex[2])
    })

    $('form.form-kelas').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()
        serrialAssoc(data)
    })

    $('#masukkanSantriModal').on('show.bs.modal', function() {
        $('#data-santri').DataTable({
            processing: true, //
            pagination: true, //
            serverSide: true, //
            searching: true, //
            ajax: {
                url: "{{ route('santri-masuk-kelas') }}", //
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
                    data: 'nis'
                }, //
                {
                    data: 'more'
                }, //
            ]
        })
    })

    $('#masukkanSantriModal').on('hidden.bs.modal', function() {
        $('#data-santri').DataTable().destroy();
        wrapperSantri.innerHTML = ''
    })

    $(document).on('click', '.masukkan-santri', function(e) {
        e.preventDefault()
        let id = $(this).data('id');
        let nama = $(this).data('nama');
        masukkan(id, nama)

    })

    $(document).on('click', '.keluarkan-santri', function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        let nama = $(this).data('nama')
        keluarkan(id, nama)
    })

    function masukkan(id, nama) {
        let route = "{{ route('masukkan-santri-kelas', ['id' => 'id_js']) }}".replace('id_js', id)
        let formData = new FormData()
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('periode_id', "{{ $currentPeriode['id'] }}")
        formData.append('kelas_id', "{{ $kelas->id }}")
        formData.append('santri_id', id)
        $.ajax({
            url: route, //
            method: 'POST', //
            dataType: 'json', //
            data: formData, //
            processData: false, //
            contentType: false, //
            success: function(res) {
                if (!res.status) {
                    toastr.error(`${nama} ${res.content}`, `${res.title}`, {
                        "progressBar": true
                    })
                } else {
                    berhasilMemasukkan(nama, res.content, res.title)
                }
            }, //
            error: function(err) {
                console.log(err.responseText)
                errorClientSide(err.responseText)
            }
        });
    }

    function keluarkan(id, nama) {
        let route = "{{ route('keluarkan-santri-kelas') }}"
        let formData = new FormData()
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('id', id)

        $.ajax({
            url: route, //
            method: 'POST', //
            dataType: 'json', //
            data: formData, //
            processData: false, //
            contentType: false, //
            success: function(res) {
                if (!res.status) {
                    toastr.error(`${nama} ${res.content}`, `${res.title}`, {
                        "progressBar": true
                    })
                } else {
                    berhasilKeluarkan(nama, res.content, res.title)
                }
            }, //
            error: function(err) {
                console.log(err.responseText)
                errorClientSide(err.responseText)
            }
        })
    }

    function berhasilMemasukkan(nama, content, title) {
        if (title == 'Berhasil') {
            let span = document.createElement('span');
            span.classList.add('badge')
            span.classList.add('badge-success')
            span.classList.add('mr-1')
            span.classList.add('mt-1')
            span.textContent = nama
            wrapperSantri.appendChild(span)

            $('#santri-kelas').DataTable().ajax.reload()

            toastr.success(`${nama} ${content}`, `${title}`, {
                "progressBar": true
            })
        } else if (title == 'Gagal') {
            toastr.error(`${nama} ${content}`, `${title}`, {
                "progressBar": true
            })
        }
    }

    function berhasilKeluarkan(nama, content, title) {
        if (title == 'Berhasil') {
            toastr.success(`${nama} ${content}`, `${title}`, {
                "progressBar": true
            })
            $('#santri-kelas').DataTable().ajax.reload()
        } else if (title == 'Gagal') {
            toastr.error(`${nama} ${content}`, `${title}`, {
                "progressBar": true
            })
        }
    }

    function loadData() {
        $('#santri-kelas').DataTable({
            processing: true, //
            pagination: true, //
            serverSide: true, //
            searching: true, //
            ajax: {
                url: "{{ route('detail-kelas', ['id' => $kelas->id, 'periode_id' => $currentPeriode['id']]) }}", //
            }, //
            columns: [{
                    data: 'DT_RowIndex', //
                    name: 'DT_RowIndex', //
                    orderable: false, //
                    searchbar: false, //
                    className: 'text-center'
                }, //
                {
                    data: 'foto', ///
                    className: 'text-center'
                }, //
                {
                    data: 'nama'
                }, //
                {
                    data: 'nis', //
                    className: 'text-center'
                }, //
                {
                    data: 'more'
                }, //
            ]
        })
    }

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        })
        prosesAjax(formData, "{{ route('edit-kelas') }}")
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
            // $('#tambahKelasModal').modal('hide')
            // $('#data-kelas').DataTable().ajax.reload()
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
        submitSimpanKelasBtn.replaceChild(span, submitSimpanKelasBtn.childNodes[0])
    }

    function populateSelectAsatidz() {
        let formData = new FormData()
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('fetchAsatidz', 'true')

        $.ajax({
            url: "{{ route('asatidz-kelas') }}", //
            method: 'POST', //
            processData: false, //
            contentType: false, //
            dataType: 'json', //
            data: formData, //
            success: function(res) {
                // Bersihkan elemen select sebelum mengisinya kembali
                $('#mustahiq_id').empty();

                // Tambahkan placeholder option
                $('#mustahiq_id').append($('<option>', {
                    value: '', //
                    text: '-- Pilih Mustahiq --', //
                    disabled: true, //
                    selected: true
                }));

                if (res.status == 'success') {
                    // Loop melalui data dan tambahkan setiap user sebagai option
                    $.each(res.data, function(index, user) {
                        $('#mustahiq_id').append($('<option>', //
                            {
                                value: user.user_id + '/' + user.avatar + '/' + user.nama, //
                                text: user.nama, //
                            }));
                    });
                }
            }, //
            error: function(error) {
                console.log(error.responseText);
            }
        });
    }

    function replaceImg(newImageName) {
        let src = "{{ route('get-foto', ['filename' => 'src_js']) }}".replace('src_js', newImageName)
        $('#foto').attr('src', src)
    }

    function replaceNamaMustahiq(nama) {
        $('#mustahiq_saat_id').val(nama)
    }

</script>

@endsection
