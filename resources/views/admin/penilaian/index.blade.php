@extends('layout.main')
@section('title', 'Penilaian')
@section('content')
<div class="row">

    <x-card-box cardTitle="Penilaian {{ Route::input('pelajaran_id') }}">
    </x-card-box>

</div>
@endsection
