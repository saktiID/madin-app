@extends('layout.main')
@section('title', 'Beranda')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-12">
        <div class="row">

            <x-widget-card col="8" theme='widget-engagement' icon='briefcase' title='{{ $nama_madin }}' subtitle='Identitas Madin' url="{{ route('identitas') }}" />
            <x-widget-card col="4" theme='widget-referral' icon='users' title='15' subtitle='Total Asatidz' url='#' />
            <x-widget-card col="4" theme='widget-followers' icon='users' title='43' subtitle='Total Santri' url='#' />
            <x-widget-card col="4" theme='widget-engagement' icon='book' title='16' subtitle='Total Pelajaran' url='#' />
            <x-widget-card col="4" theme='widget-referral' icon='award' title='6' subtitle='Total Kelas' url='#' />


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
