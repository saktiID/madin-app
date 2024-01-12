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
                            <select name="kelas_id" id="kelas_id" class="form-control" required>
                                <option value="" disabled selected>-- Pilih kelas --</option>
                                @foreach ($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelas . ' ' . $item->bagian_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
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
            $('.simpan-nilai').attr('hidden', false)
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
                ]
            })
        }

    })

</script>

@endsection
