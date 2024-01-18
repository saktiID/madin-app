<div class="modal fade" id="tambahPeriodeModal" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="tambahPeriodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPeriodeModalLabel">Tambah Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <form action="#" class="tambah-periode">
                    <div class="form-row">
                        <div class="col-lg-12 col-sm-12">

                            @csrf

                            <div class="alert alert-light-warning">
                                <span>Detail Periode</span>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="semester">Semester</label>
                                        <select name="semester" id="semester" class="form-control selectpicker" required>
                                            <option value="">-- Semester --</option>
                                            <option value="Ganjil">Ganjil</option>
                                            <option value="Genap">Genap</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6">
                                    <div class="mb-3">
                                        <label for="tahun_pertama">Tahun Pertama</label>
                                        <input type="text" value="" id="tahun_pertama" name="tahun_pertama" class="form-control" placeholder="Contoh: 2023" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="mb-3">
                                        <label for="tahun_kedua">Tahun Kedua</label>
                                        <input type="text" value="" id="tahun_kedua" name="tahun_kedua" class="form-control" placeholder="Contoh: 2024" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="alert alert-light-warning">
                                        <span>Ketik ulang kode konfirmasi berikut: <span class="badge badge-dark" id="display_kode_konfirmasi" style="user-select: none;">code</span></span>
                                        <input type="text" name="kunci_kode_konfirmasi" id="kunci_kode_konfirmasi" value="" hidden>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="kode_konfirmasi">Kode Konfirmasi</label>
                                        <input type="text" value="" id="kode_konfirmasi" name="kode_konfirmasi" class="form-control" required>
                                        <small>Huruf kapital berpengaruh.</small>
                                    </div>
                                    <div class="mb-3">
                                        <i class="d-block"><b>** Pastikan membuat periode sesuai kebutuhan.</b></i>
                                        <i class="d-block"><b>** Periode yang sudah dibuat tidak bisa dihapus.</b></i>
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
