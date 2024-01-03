<x-menu-item-heading menuHeadingName="PENILAIAN" />
@foreach ($pelajaran as $p )
<x-menu-item-penilaian menuTitle="{{ $p->nama_pelajaran }}" menuIcon="book" route="penilaian" classActive="penilaian/{{ $p->id }}" pelajaranId="{{ $p->id }}" />
@endforeach
