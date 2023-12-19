<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <div class="alert alert-gradient d-flex justify-content-between align-items-center" role="alert">
            <span>Periode saat ini: <strong>Semester 1 Tahun Ajaran 2023/2024</strong></span>
            <button type="button" class="btn btn-warning mr-0" data-toggle="modal" data-target="#periodeModal">
                Pindah periode
            </button>
        </div>
    </div>

</div>




<!-- Modal -->
<div class="modal fade" id="periodeModal" tabindex="-1" role="dialog" aria-labelledby="periodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodeModalLabel">Pilih periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form>
                <div class="modal-body">

                    <div class="input-group mb-2 mr-sm-2">
                        <select id="semester" class="form-control">
                            <option selected="">-- Semester --</option>
                            <option>Semester 1</option>
                            <option>Semester 2</option>
                        </select>
                        <select id="tahun-ajaran" class="form-control">
                            <option selected="">-- Tahun Ajaran --</option>
                            <option>...</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
