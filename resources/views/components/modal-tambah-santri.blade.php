<div class="modal fade" id="tambahSantriModal" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="tambahSantriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSantriModalLabel">Tambah Santri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('tambah-santri') }}" method="post" class="tambah-santri">
                    <div class="form-row">
                        <div class="col-lg-12 col-sm-12">

                            @csrf

                            <div class="alert alert-light-warning">
                                <span>Biodata Santri <i>(Data diri)</i></span>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nama">Nama Santri</label>
                                        <input type="text" value="" id="nama" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="gender">Gender Santri</label>
                                        <select value="" id="gender" name="gender" class="form-control" required>
                                            <option value="">-- Pilih Gender --</option>
                                            <option value="male">Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nik">NIK Santri <i>(NIK 16 digit)</i></label>
                                        <input type="number" value="" id="nik" name="nik" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nis">NIS Santri</label>
                                        <input type="text" value="" id="nis" name="nis" class="form-control" required>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tempat_lahir">Tempat Lahir Santri</label>
                                        <input type="text" value="" id="tempat_lahir" name="tempat_lahir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir">Tanggal Lahir Santri <i>(dd/mm/yyyy)</i></label>
                                        <input type="text" value="" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="alamat">Alamat Santri <i>(Alamat lengkap)</i></label>
                                <input type="text" value="" id="alamat" name="alamat" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="kabupaten">Kabupaten Santri</label>
                                        <input type="text" value="" id="kabupaten" name="kabupaten" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="provinsi">Provinsi Santri</label>
                                        <input type="text" value="" id="provinsi" name="provinsi" class="form-control" required>
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
