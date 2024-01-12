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

                            <div id="circle-basic" class="">

                                <h3>Data Santri</h3>
                                <section class="p-2">

                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="mb-3">
                                                <label for="nama">Nama Santri</label>
                                                <input type="text" value="" id="nama" name="nama" class="form-control" required>
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
                                                <label for="no_kk">No. KK</label>
                                                <input type="text" value="" id="no_kk" name="no_kk" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                                <input type="text" value="" id="nama_kepala_keluarga" name="nama_kepala_keluarga" class="form-control">
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

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="jumlah_saudara">Jumlah Saudara</label>
                                                <input type="text" value="" id="jumlah_saudara" name="jumlah_saudara" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="anak_ke">Anak ke-</label>
                                                <input type="text" value="" id="anak_ke" name="anak_ke" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="cita_cita">Cita-cita</label>
                                                <input type="text" value="" id="cita_cita" name="cita_cita" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="hobi">Hobi</label>
                                                <input type="text" value="" id="hobi" name="hobi" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="telp">No. Telp</label>
                                                <input type="text" value="" id="telp" name="telp" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="email">Email</label>
                                                <input type="text" value="" id="email" name="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="pembiaya">Yang membiayai</label>
                                                <select id="pembiaya" name="pembiaya" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Orang tua">Orang tua</option>
                                                    <option value="Wali/Orang tua asuh">Wali/Orang tua asuh</option>
                                                    <option value="Tanggungan sendiri">Tanggungan sendiri</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                                                <select name="kebutuhan_khusus" id="kebutuhan_khusus" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Tidak ada">Tidak ada</option>
                                                    <option value="Lamban belajar">Lamban belajar</option>
                                                    <option value="Kesulitan belajar spesifik">Kesulitan belajar spesifik</option>
                                                    <option value="Gangguan komunikasi">Gangguan komunikasi</option>
                                                    <option value="Berbakat/Memiliki kemampuan dan kecerdasan luar biasa">Berbakat/Memiliki kemampuan dan kecerdasan luar biasa</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="kebutuhan_disabilitas">Kebutuhan Disabilitas</label>
                                                <select name="kebutuhan_disabilitas" id="kebutuhan_disabilitas" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Tidak ada">Tidak ada</option>
                                                    <option value="Tuna netra">Tuna netra</option>
                                                    <option value="Tuna rungu">Tuna rungu</option>
                                                    <option value="TUna daksa">TUna daksa</option>
                                                    <option value="Tuna grahita">Tuna grahita</option>
                                                    <option value="Tuna laras">Tuna laras</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
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

                                </section>

                                <h3>Data Orang Tua</h3>
                                <section class="p-2">

                                    {{-- data ayah --}}
                                    <div class=" row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="nama_ayah">Nama Ayah</label>
                                                <input type="text" value="" id="nama_ayah" name="nama_ayah" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="status_ayah">Status Ayah</label>
                                                <select name="status_ayah" id="status_ayah" name="status_ayah" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Masih hidup">Masih hidup</option>
                                                    <option value="Sudah meninggal">Sudah meninggal</option>
                                                    <option value="Tidak diketahui">Tidak diketahui</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="kewarganegaraan_ayah">Kewarganegaraan Ayah</label>
                                                <select name="kewarganegaraan_ayah" id="kewarganegaraan_ayah" class="form-control">
                                                    <option value=""></option>
                                                    <option value="WNI">WNI</option>
                                                    <option value="WNA">WNA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="nik_ayah">NIK Ayah</label>
                                                <input value="" type="text" id="nik_ayah" name="nik_ayah" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                                                    <input value="" type="text" id="tempat_lahir_ayah" name="tempat_lahir_ayah" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                                                    <input value="" type="text" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="pendidikan_terakhir_ayah">Pendidikan Terakhir Ayah</label>
                                                <input value="" type="text" id="pendidikan_terakhir_ayah" name="pendidikan_terakhir_ayah" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                                <input value="" type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="penghasilan_ayah">Penghasilan Ayah</label>
                                                <select name="penghasilan_ayah" id="penghasilan_ayah" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Kurang dari 500.000">Kurang dari 500.000</option>
                                                    <option value="500.000 - 1.000.000">500.000 - 1.000.000</option>
                                                    <option value="1.000.000 - 2.000.000">1.000.000 - 2.000.000</option>
                                                    <option value="2.000.000 - 3.000.000">2.000.000 - 3.000.000</option>
                                                    <option value="3.000.000 - 5.000.000">3.000.000 - 5.000.000</option>
                                                    <option value="Lebih dari 5.000.000">Lebih dari 5.000.000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="telp_ayah">No. Telp Ayah</label>
                                                    <input value="" type="text" id="telp_ayah" name="telp_ayah" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- data ibu --}}
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="nama_ibu">Nama Ibu</label>
                                                <input type="text" value="" id="nama_ibu" name="nama_ibu" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="status_ibu">Status Ibu</label>
                                                <select name="status_ibu" id="status_ibu" name="status_ibu" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Masih hidup">Masih hidup</option>
                                                    <option value="Sudah meninggal">Sudah meninggal</option>
                                                    <option value="Tidak diketahui">Tidak diketahui</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="kewarganegaraan_ibu">Kewarganegaraan Ibu</label>
                                                <select name="kewarganegaraan_ibu" id="kewarganegaraan_ibu" class="form-control">
                                                    <option value=""></option>
                                                    <option value="WNI">WNI</option>
                                                    <option value="WNA">WNA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="nik_ibu">NIK Ibu</label>
                                                <input value="" type="text" id="nik_ibu" name="nik_ibu" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                                                    <input value="" type="text" id="tempat_lahir_ibu" name="tempat_lahir_ibu" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                                                    <input value="" type="text" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="pendidikan_terakhir_ibu">Pendidikan Terakhir Ibu</label>
                                                <input value="" type="text" id="pendidikan_terakhir_ibu" name="pendidikan_terakhir_ibu" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                                <input value="" type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="penghasilan_ibu">Penghasilan Ibu</label>
                                                <select name="penghasilan_ibu" id="penghasilan_ibu" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Kurang dari 500.000">Kurang dari 500.000</option>
                                                    <option value="500.000 - 1.000.000">500.000 - 1.000.000</option>
                                                    <option value="1.000.000 - 2.000.000">1.000.000 - 2.000.000</option>
                                                    <option value="2.000.000 - 3.000.000">2.000.000 - 3.000.000</option>
                                                    <option value="3.000.000 - 5.000.000">3.000.000 - 5.000.000</option>
                                                    <option value="Lebih dari 5.000.000">Lebih dari 5.000.000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="telp_ibu">No. Telp Ibu</label>
                                                    <input value="" type="text" id="telp_ibu" name="telp_ibu" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <h3>Data Alamat</h3>
                                <section class="p-2">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="alamat">Alamat Santri <i>(Alamat lengkap)</i></label>
                                                <input type="text" value="" id="alamat" name="alamat" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-cm-12">
                                            <div class="mb-3">
                                                <label for="rt">RT</label>
                                                <input type="text" value="" id="rt" name="rt" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-cm-12">
                                            <div class="mb-3">
                                                <label for="rw">RW</label>
                                                <input type="text" value="" id="rw" name="rw" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-cm-12">
                                            <div class="mb-3">
                                                <label for="kelurahan">Kelurahan</label>
                                                <input type="text" value="" id="kelurahan" name="kelurahan" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-cm-12">
                                            <div class="mb-3">
                                                <label for="kode_pos">Kode Pos</label>
                                                <input type="text" value="" id="kode_pos" name="kode_pos" class="form-control">
                                            </div>
                                        </div>
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

                                </section>
                            </div>

                            <input type="text" name="tahun_masuk" value="{{ date("Y") }}" hidden>
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
