<div class="modal fade" id="tambahPelajaranModal" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="tambahPelajaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPelajaranModalLabel">Tambah Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('tambah-pelajaran') }}" method="post" class="tambah-pelajaran">
                    <div class="form-row">
                        <div class="col-lg-12 col-sm-12">

                            @csrf

                            <div class="alert alert-light-warning">
                                <span>Detail Pelajaran</span>
                            </div>


                            <div class="mb-3">
                                <label for="nama_pelajaran">Nama Pelajaran</label>
                                <input type="text" value="" id="nama_pelajaran" name="nama_pelajaran" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi">Deskripsi Pelajaran</label>
                                <input type="text" value="" id="deskripsi" name="deskripsi" class="form-control" required>
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
