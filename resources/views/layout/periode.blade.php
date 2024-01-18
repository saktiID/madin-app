<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <div class="alert alert-gradient d-flex justify-content-between align-items-center" role="alert">
            <span>Periode saat ini: <strong>Semester {{ $currentPeriode['semester'] }} Tahun Ajaran {{ $currentPeriode['tahun_ajaran'] }}</strong></span>
            <button type="button" class="btn btn-warning mr-0" data-toggle="modal" data-target="#periodeModal">
                Pindah periode
            </button>
        </div>
    </div>

</div>




<!-- Modal -->

<x-modal-box modalId="periodeModal" modalTitle="Pilih Periode" modalUrl="{{ route('set-periode') }}" modalSubmitText="Simpan">
    <div class="alert alert-icon-left alert-light-warning" role="alert">
        <i data-feather="alert-triangle"></i>
        <strong>Perhatian!</strong> <span>Wajib memilih periode terlebih dahulu.</span>
    </div>
    <div class="input-group mb-2 mr-sm-2">
        <select name="periode" id="periode" class="form-control selectpicker" required>
            <option value="">-- Periode --</option>
            @foreach ($periode as $p )
            <option value="{{ $p->id }}">{{ $p->semester }} {{ $p->tahun_ajaran }}</option>
            @endforeach
        </select>
    </div>
</x-modal-box>

@section('script-layout')
<script>
    const submitPeriodeBtnModal = document.querySelector('#periodeModal .modal-dialog .modal-content .modal-footer')
    const newSubmitPeriodeBtnModal = document.createElement('button')
    newSubmitPeriodeBtnModal.type = "submit"
    newSubmitPeriodeBtnModal.innerText = "Simpan"
    newSubmitPeriodeBtnModal.classList.add('btn')
    newSubmitPeriodeBtnModal.classList.add('btn-primary')
    newSubmitPeriodeBtnModal.classList.add('simpan-periode')
    submitPeriodeBtnModal.replaceChild(newSubmitPeriodeBtnModal, submitPeriodeBtnModal.childNodes[3])

    const submitSimpanPeriodeBtn = document.querySelector('button[type="submit"].simpan-periode')
    submitSimpanPeriodeBtn.addEventListener('click', () => {
        let valPeriode = document.getElementById('periode').value
        if (valPeriode) {
            const spinner = document.createElement('div')
            spinner.classList = "spinner-border text-white align-self-center loader-sm"
            submitSimpanPeriodeBtn.replaceChild(spinner, submitSimpanPeriodeBtn.childNodes[0])
        }
    })

</script>
@endsection
