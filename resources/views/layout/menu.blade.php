<x-menu-item menuTitle="Beranda" menuIcon="home" route="beranda" classActive="beranda" />
<x-menu-item menuTitle="Keluar" menuIcon="log-out" route="logout" dataToggle="modal" dataTarget="#logoutModal" />


{{-- BEGIN ADMIN MENU --}}

@if (Auth::user()->role == "Administrator")
@include('layout.admin-menu')
@endif

{{-- END ADMIN MENU --}}


{{-- BEGIN PENILAIAN MENU --}}
@include('layout.penilaian-menu')
{{-- END PENILAIAN MENU --}}


{{-- modal --}}
@section('modal')
<x-modal-box modalId="logoutModal" modalTitle="Keluar" modalUrl="{{ route('logout') }}" modalSubmitText="Tetap keluar" classSubmit="danger logout">
    <p>Apakah yakin akan keluar?</p>
</x-modal-box>
@endsection
{{-- end modal --}}
