@extends('layout.main')
@section('title', 'Penilaian')
@section('content')
<div class="row">

    <x-card-box cardTitle="Penilaian {{ $pelajaran_target->nama_pelajaran }}">

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="mb-4 mx-3">
                    <form action="#" class="lihat-nilai">
                        <div class="input-group">
                            <select name="kelas_id" id="kelas_id" class="form-control selectpicker" required>
                                <option value="" disabled selected>-- Pilih kelas --</option>
                                @foreach ($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelas . ' ' . $item->bagian_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="mb-4 mx-3  d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <div class="btn btn-info" id="download"><i data-feather="download"></i> Download</div>
                        <div class="btn btn-success" id="upload"><i data-feather="upload"></i> Upload</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="#" class="insert-or-update-nilai">
                    <x-datatable-responsive tableId="penilaian-santri">
                        <thead class="bg-succcess">
                            <tr class="text-center">
                                <th rowspan="2" style="vertical-align: middle;" width="10%">No</th>
                                <th rowspan="2" style="vertical-align: middle;" width="15%">NIS</th>
                                <th rowspan="2" style="vertical-align: middle;" width="35%">Nama</th>
                                <th colspan="2">Nilai</th>
                            </tr>
                            <tr class="text-center">
                                <th width="20%">Musyafahat</th>
                                <th width="20%">Kitabah</th>
                            </tr>
                        </thead>
                    </x-datatable-responsive>
                    <div class="my-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-3 simpan-nilai" hidden>Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </x-card-box>

    <form action="{{ route('penilaian-download') }}" method="GET" id="form-download-template" hidden>
        <input type="text" name="periode_id" value="{{ $currentPeriode['id'] }}">
        <input type="text" name="pelajaran_id" value="{{ $pelajaran_target->id }}">
        <input type="text" name="kelas_id" id="kelas_id_to_download">
    </form>

    <form action="{{ route('penilaian-upload') }}" method="POST" id="form-upload" enctype="multipart/form-data" hidden>
        <input type="file" name="excelFile" id="excelFile" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
    </form>

    {{-- modal upload --}}
    <x-modal-upload-nilai>

        <div class="text-center mb-2">
            <p>Mengupload nilai</p>
            <strong id="fileTitle"></strong>
        </div>
        <div class="progress br-30 progress-md mb-1">
            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="text-center">
            <span class="mb-4"><img src="{{ asset('assets/img/sesttings.gif') }}" alt="proses" width="20px"> Sedang memporses...</span>
        </div>

    </x-modal-upload-nilai>

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

        let formData
        let penilaian
        const btn_simpan = document.querySelector('.simpan-nilai');

        (function() {
            let kelas_id = document.getElementById('kelas_id').value;
            if (!kelas_id) {
                formData = {
                    _token: '{{ csrf_token() }}', //
                    periode_id: "{{ $currentPeriode['id'] }}", //
                    pelajaran_id: '{{ $pelajaran_target->id }}', //
                    kelas_id: '-', //
                }
            }
            loadData()
        })();

        $('form.lihat-nilai').on('change', function(e) {
            e.preventDefault()
            formData = {
                _token: '{{ csrf_token() }}', //
                periode_id: "{{ $currentPeriode['id'] }}", //
                pelajaran_id: '{{ $pelajaran_target->id }}', //
                kelas_id: document.getElementById('kelas_id').value, //
            }
            penilaian.destroy();
            loadData()
        })

        $('form.insert-or-update-nilai').on('submit', function(e) {
            e.preventDefault()
            let data = $(this).serializeArray()

            let nilai = []
            data.forEach(element => {
                nilai.push({
                    'tanda_nilai': element.name, //
                    'isi_nilai': element.value
                })
            });
            let params = [{
                    name: '_token', //
                    value: "{{ csrf_token() }}"
                }, // 
                {
                    name: 'pelajaran_id', //
                    value: '{{ $pelajaran_target->id }}'
                }, //
                {
                    name: 'periode_id', //
                    value: "{{ $currentPeriode['id'] }}"
                }, //
                {
                    name: 'kelas_id', //
                    value: document.getElementById('kelas_id').value
                }, //
                {
                    name: 'nilai', //
                    value: JSON.stringify(nilai)
                }
            ]

            let formDataNilai = new FormData()
            params.forEach(element => {
                formDataNilai.append(element.name, element.value)
            })

            prosesAjax(formDataNilai, "{{ route('simpan-penilaian') }}")
        })

        $('.simpan-nilai').on('click', function(e) {
            const spinner = document.createElement('div')
            spinner.classList = "spinner-border text-white align-self-center loader-sm"
            btn_simpan.replaceChild(spinner, btn_simpan.childNodes[0])
        })

        $('#download').on('click', function() {
            if (!document.getElementById('kelas_id').value) {
                Swal.fire({
                    type: 'error', //
                    title: 'Oops...', //
                    text: 'Pilih kelas terlebih dahulu', //
                })
            } else if (penilaian.rows().count() == 0) {

                Swal.fire({
                    type: 'error', //
                    title: 'Oops...', //
                    text: 'Tidak ada siswa dalam kelas', //
                })
            } else {
                $('#kelas_id_to_download').val(document.getElementById('kelas_id').value)
                $('form#form-download-template').submit()
            }
        })

        $('#upload').on('click', function() {
            if (!document.getElementById('kelas_id').value) {
                Swal.fire({
                    type: 'error', //
                    title: 'Oops...', //
                    text: 'Pilih kelas terlebih dahulu', //
                })
            } else if (penilaian.rows().count() == 0) {

                Swal.fire({
                    type: 'error', //
                    title: 'Oops...', //
                    text: 'Tidak ada siswa dalam kelas', //
                })
            } else {
                $('input#excelFile').click()
            }
        })

        $('form#form-upload').on('change', function(e) {
            $('#uploadNilaiModal').modal('show');
            let fileTitle = $('input#excelFile').val()
            document.getElementById('fileTitle').innerHTML = fileTitle

            const excelFile = $('input#excelFile').prop('files')[0]
            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}")
            formData.append('excelFile', excelFile)
            formData.append('pelajaran_id_target', "{{ $pelajaran_target->id }}")

            $.ajax({
                url: "{{ route('penilaian-upload') }}", //
                type: 'POST', //
                data: formData, //
                contentType: false, //
                processData: false, //
                xhr: function() {
                    var xhr = new window.XMLHttpRequest()
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total
                            percentComplete = parseInt(percentComplete * 100)
                            $('.progress-bar').css('width', percentComplete + '%')
                        }
                    }, false);
                    return xhr;
                }, //
                success: function(res) {
                    resetUploadModal(res);
                    penilaian.destroy();
                    loadData()
                }, //
                error: function(res) {
                    resetUploadModal(res);
                }
            })
        })

        function resetUploadModal(res) {
            setTimeout(() => {
                $('#uploadNilaiModal').modal('hide');
                document.querySelector("form#form-upload").reset()
                document.getElementById('fileTitle').innerHTML = ''
                $('.progress-bar').css('width', '0' + '%')
                if (res.status) {
                    sweetAlert(res.data)
                }
            }, 1500);
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
                    console.log(res);
                    btn_simpan.innerHTML = 'Simpan'
                }, //
                error: function(err) {
                    console.log(err.responseText)
                    errorClientSide(err.responseText)
                    btn_simpan.innerHTML = 'Simpan'
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
                console.log(divError);
                sweetAlert(data)
            } else {
                sweetAlert(res.data)
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

        function loadData() {
            penilaian = $('#penilaian-santri').DataTable({
                searching: false, //
                paging: false, //
                info: false, //
                processing: true, //
                serverSide: true, //
                ajax: {
                    url: "{{ route('penilaian', ['pelajaran_id' => $pelajaran_target->id ]) }}", //
                    dataType: 'json', //
                    data: {
                        _token: formData._token, //
                        periode_id: formData.periode_id, //
                        pelajaran_id: formData.pelajaran_id, //
                        kelas_id: formData.kelas_id, //
                    }
                }, //
                oLanguage: {
                    sProcessing: "<div class='spinner-border text-primary align-self-center loader-sm'></div>"
                }, //
                columns: [{
                        data: 'DT_RowIndex', //
                        name: 'DT_RowIndex', //
                        orderable: false, //
                        searchbar: false, //
                        className: 'text-center'
                    }, //
                    {
                        data: 'nis', //
                    }, //
                    {
                        data: 'nama', //
                    }, //
                    {
                        data: 'musyafahat'
                    }, //
                    {
                        data: 'kitabah', //
                        className: 'text-center'
                    }, //
                ], //
                fnDrawCallback: function() {
                    if (penilaian.rows().count() === 0) {
                        $('.simpan-nilai').attr('hidden', true)
                    } else {
                        $('.simpan-nilai').attr('hidden', false)
                    }
                }
            })
        }

    })

</script>

@endsection
