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

@endsection
