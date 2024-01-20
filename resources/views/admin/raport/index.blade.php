@extends('layout.main')
@section('title', 'Raport')
@section('content')
<div class="row">

    <x-card-box cardTitle="Raport">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="mb-4 mx-3">
                    <form action="#" class="raport-kelas">

                        <select name="kelas_id" id="kelas_id" class="form-control selectpicker" required>
                            <option value="" disabled selected>-- Pilih kelas --</option>
                            @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kelas . ' ' . $item->bagian_kelas }}</option>
                            @endforeach
                        </select>

                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="mb-4 mx-3">
                    <form action="#" class="buat-raport">
                        <input type="text" name="tanggal_raport" id="tanggal_raport" placeholder="Atur tanggal raport" class="form-control" style="height: 50px" required />
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <x-datatable-responsive tableId="raport-santri">
                    <thead>
                        <tr class="text-center">
                            <th width="10%">No</th>
                            <th width="10%">Foto</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th><i data-feather="more-horizontal"></i></th>
                        </tr>
                    </thead>
                </x-datatable-responsive>

            </div>
        </div>
    </x-card-box>

    <form action="" method="POST" id="getRaport" target="_blank" hidden>
        @csrf
        <input type="tanggal_raport" name="tanggal_raport" id="tglGetRaport">
    </form>

</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/flatpickr/flatpickr.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/my-flatpickr.js') }}"></script>
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<x-sweet-alert />

<script>
    $(document).ready(function() {

        let formData
        let raport

        (function() {
            let kelas_id = document.getElementById('kelas_id').value;
            if (!kelas_id) {
                formData = {
                    periode_id: "{{ $currentPeriode['id'] }}", //
                    kelas_id: '-', //
                }
            }
            loadData()
        })();

        $('form.raport-kelas').on('change', function(e) {
            e.preventDefault()
            formData = {
                periode_id: "{{ $currentPeriode['id'] }}", //
                kelas_id: document.getElementById('kelas_id').value, //
            }
            raport.destroy();
            loadData()
        })

        $('form.buat-raport').on('change', function(e) {
            e.preventDefault()
            let data = {
                type: 'success', //
                title: 'Alhamdulillah!', //
                html: 'Tanggal raport berhasil diatur menjadi </br>' + $('#tanggal_raport').val(), //
                footer: '<small>Ketika sudah mencetak raport, tanggal tidak bisa diubah.</small>', //
            }
            $('#tanggal_raport').blur()
            Swal.fire(data)
        })

        $(document).on('click', '.print-raport', function(e) {
            e.preventDefault()

            if ($('#tanggal_raport').val()) {
                $('form#getRaport').attr('action', $(this).attr('href'))
                $('input#tglGetRaport').val($('#tanggal_raport').val())
                $('form#getRaport').submit()

            } else {
                errorClientSide('Tanggal raport belum diatur');
            }
        })

        function errorClientSide(err) {
            let data = {
                icon: 'error', //
                title: 'Oops!', //
                html: err
            }
            sweetAlert(data)
        }

        function loadData() {
            raport = $('#raport-santri').DataTable({
                searching: false, //
                paging: false, //
                info: false, //
                processing: true, //
                serverSide: true, //
                ajax: {
                    url: "{{ route('raport') }}", //
                    dataType: 'json', //
                    data: {
                        periode_id: formData.periode_id, //
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
                        data: 'foto', //
                    }, //
                    {
                        data: 'nama', //
                    }, //
                    {
                        data: 'nis'
                    }, //
                    {
                        data: 'more', //
                        className: 'text-center'
                    }, //
                ]
            })
        }
    })
    $('#tanggal_raport').flatpickr({
        dateFormat: 'd F Y'
    })

</script>
@endsection
