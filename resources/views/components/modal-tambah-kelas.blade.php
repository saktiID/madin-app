<div class="modal fade" id="tambahKelasModal" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKelasModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <form action="#" method="post" class="tambah-kelas">
                    <div class="form-row">
                        <div class="col-lg-12 col-sm-12">

                            @csrf

                            <input type="text" name="periode_id" value="{{ $periodeId }}" hidden>

                            <div class="alert alert-light-warning">
                                <span>Detail Kelas | Periode: Semester {{ $semester . ' '. $tahun }} </span>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="jenjang_kelas">Jenjang</label>
                                        <select name="jenjang_kelas" id="jenjang_kelas" class="form-control selectpicker" required>
                                            <option value="">-- Pilih Jenjang --</option>
                                            @for($i = 1; $i < 13; $i++) <option value="{{ $i }}">Jenjang - {{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nama_kelas">Nama Kelas</label>
                                        <input type="text" value="" id="nama_kelas" name="nama_kelas" class="form-control" placeholder="contoh: 1 Ibtida'iyyah" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="bagian_kelas">Bagian Kelas</label>
                                        <input type="text" value="" id="bagian_kelas" name="bagian_kelas" class="form-control" placeholder="contoh: A" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="tambahBtn" hidden></button>

                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Batalkan</button>
                <button type="submit" class="btn btn-primary" id="tambahTrigger">Tambah</button>
            </div>
        </div>
    </div>
</div>

<script>
    const tambahBtn = document.getElementById('tambahBtn')
    const tambahTrigger = document.getElementById('tambahTrigger')

    tambahTrigger.addEventListener('click', () => {
        tambahBtn.click()
    })

</script>
