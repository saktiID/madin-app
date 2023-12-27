<div class="modal fade" id="tambahAsatidzModal" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="tambahAsatidzModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAsatidzModalLabel">Tambah Asatidz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('tambah-asatidz') }}" method="post" class="tambah-asatidz">
                    <div class="form-row">
                        <div class="col-lg-12 col-sm-12">

                            @csrf

                            <div class="alert alert-light-warning">
                                <span>Data Pengguna <i>(Credential)</i></span>
                            </div>

                            <div class="mb-3">
                                <label for="nama_asatidz">Nama Asatidz</label>
                                <input type="text" value="" id="nama_asatidz" name="nama" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email_asatidz">Email Asatidz</label>
                                <input type="email" value="" id="email_asatidz" name="email" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="gender_asatidz">Gender Asatidz</label>
                                        <select id="gender_asatidz" name="gender" class="form-control" required>
                                            <option value="">-- Pilih Gender --</option>
                                            <option value="male">Laki-laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="role_asatidz">Role Asatidz</label>
                                        <select id="role_asatidz" name="role" class="form-control" required>
                                            <option value="">-- Pilih Role --</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Asatidz">Asatidz</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="password_asatidz">Password Asatidz</label>
                                        <input type="password" value="" id="password_asatidz" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="konfirmasi_password_asatidz">Konfirmasi Password Asatidz</label>
                                        <input type="password" value="" id="konfirmasi_password_asatidz" name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>
                            </div>


                            <div class="alert alert-light-warning">
                                <span>Biodata Asatidz <i>(Data diri)</i></span>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nik_asatidz">NIK Asatidz <i>(NIK 16 digit)</i></label>
                                        <input type="number" value="" id="nik_asatidz" name="nik" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="telp_asatidz">Telp Asatidz</label>
                                        <input type="text" value="" id="telp_asatidz" name="telp" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tempat_lahir_asatidz">Tempat Lahir Asatidz</label>
                                        <input type="text" value="" id="tempat_lahir_asatidz" name="tempat_lahir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir_asatidz">Tanggal Lahir Asatidz <i>(dd/mm/yyyy)</i></label>
                                        <input type="text" value="" id="tanggal_lahir_asatidz" name="tanggal_lahir" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="pendidikan_terakhir_asatidz">Pendidikan Terkahir Asatidz <i>(Formal)</i></label>
                                        <input type="text" value="" id="pendidikan_terakhir_asatidz" name="pendidikan_terakhir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="pendidikan_islam_asatidz">Pendidikan Islam Asatidz <i>(Pesantren)</i></label>
                                        <input type="text" value="" id="pendidikan_islam_asatidz" name="pendidikan_islam" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_asatidz">Alamat Asatidz <i>(Alamat lengkap)</i></label>
                                <input type="text" value="" id="alamat_asatidz" name="alamat" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="kabupaten_asatidz">Kabupaten Asatidz</label>
                                        <input type="text" value="" id="kabupaten_asatidz" name="kabupaten" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="provinsi_asatidz">Provinsi Asatidz</label>
                                        <input type="text" value="" id="provinsi_asatidz" name="provinsi" class="form-control" required>
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
