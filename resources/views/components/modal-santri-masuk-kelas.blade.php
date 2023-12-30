<div class="modal fade" id="masukkanSantriModal" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="masukkanSantriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masukkanSantriModalLabel">Masukkan Santri ke Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <form action="#" method="post" class="santri-masuk-kelas">
                    <div class="form-row">
                        <div class="col-lg-12 col-sm-12">

                            @csrf

                            <input type="text" name="kelas_id" value="{{ $kelasId }}" hidden>

                            <div class="alert alert-light-warning">
                                <span>Pilih santri untuk masuk ke kelas </span>
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
