@extends('layout.main')
@section('title', 'Beranda')
@section('content')
<div class="row">

    <div class="col-lg-12 col-md-12 col-12 col-12">
        <div class="row">

            <x-widget-card col="12" theme='widget-engagement' icon='briefcase' title='{{ $nama_madin }}' subtitle='Identitas Madin' url="{{ route('identitas') }}" />
            <x-widget-card col="4" theme='widget-referral' icon='users' title='{{ $countAsatidz }}' subtitle='Total Asatidz' url="{{ route('data-asatidz') }}" />
            <x-widget-card col="4" theme='widget-followers' icon='users' title='{{ $countSantri }}' subtitle='Total Santri' url="{{ route('data-santri') }}" />
            <x-widget-card col="4" theme='widget-engagement' icon='book' title='{{ $countPelajaran }}' subtitle='Total Pelajaran' url="{{ route('data-pelajaran') }}" />

        </div>
    </div>

</div>
@endsection


@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/dashboard/dash_2.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script>
    @if(session('response'))
    let data = @json(session('response'));
    sweetAlert(data)
    @endif

</script>
@endsection
