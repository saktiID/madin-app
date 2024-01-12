@extends('layout.main')
@section('title', 'Detail Profile Santri')
@section('content')
<div class="row">

    <x-card-box cardTitle="Detail Profile Santri">

        <div class="form-row">
            <div class="col-lg-4 col-sm-12 mb-4">

                <a href="{{ route('data-santri') }}">
                    <div class="alert alert-outline-primary">
                        <span>&larr; Kembali ke Data Santri</span>
                    </div>
                </a>

                <label>Profile Santri</label>
                <input type="file" accept="image/*" id="avatar" name="avatar" hidden>
                <div class="text-center">
                    <div class="avatar avatar-xl mb-4">
                        <img alt="foto" id="foto" src="{{ route('get-foto', ['filename' => $santri->avatar]) }}" width="250px" height="250px" class="rounded bg-success" />
                    </div>
                    <label for="avatar" class="btn btn-outline-primary btn-sm">Ubah foto</label>
                </div>

                <x-modal-box modalId="uploadImgModal" modalTitle="Upload foto" modalUrl="#" modalSubmitText="Upload">
                    <div class="d-flex justify-content-center">
                        <img src="" id="previewImg" alt="preview" height="450px">
                    </div>
                </x-modal-box>

                <div class="mb-3">
                    <label>Kelengkapan profile</label>
                    <div class="progress br-30">
                        <div class="progress-bar bg-gradient-primary" role="progressbar" style="width:0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>

            </div>


            <div class="col-lg-8 col-sm-12">
                <form class="form-biodata mb-4">
                    @csrf

                    <input type="text" name="id" value="{{ $santri->id }}" hidden>

                    <div id="circle-basic" class="">

                        <h3>Data Santri</h3>
                        <section class="p-2">

                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nama">Nama Santri</label>
                                        <input type="text" value="{{ $santri->nama }}" id="nama" name="nama" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nik">NIK Santri <i>(NIK 16 digit)</i></label>
                                        <input type="number" value="{{ $santri->nik }}" id="nik" name="nik" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nis">NIS Santri</label>
                                        <input type="text" value="{{ $santri->nis }}" id="nis" name="nis" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="no_kk">No. KK</label>
                                        <input type="text" value="{{ $santri->no_kk }}" id="no_kk" name="no_kk" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nama_kepala_keluarga">Nama Kepala Keluarga</label>
                                        <input type="text" value="{{ $santri->nama_kepala_keluarga }}" id="nama_kepala_keluarga" name="nama_kepala_keluarga" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tempat_lahir">Tempat Lahir Santri</label>
                                        <input type="text" value="{{ $santri->tempat_lahir }}" id="tempat_lahir" name="tempat_lahir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir">Tanggal Lahir Santri <i>(dd/mm/yyyy)</i></label>
                                        <input type="text" value="{{ $santri->tanggal_lahir }}" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="jumlah_saudara">Jumlah Saudara</label>
                                        <input type="text" value="{{ $santri->jumlah_saudara }}" id="jumlah_saudara" name="jumlah_saudara" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="anak_ke">Anak ke-</label>
                                        <input type="text" value="{{ $santri->anak_ke }}" id="anak_ke" name="anak_ke" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="cita_cita">Cita-cita</label>
                                        <input type="text" value="{{ $santri->cita_cita }}" id="cita_cita" name="cita_cita" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="hobi">Hobi</label>
                                        <input type="text" value="{{ $santri->hobi }}" id="hobi" name="hobi" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="telp">No. Telp</label>
                                        <input type="text" value="{{ $santri->telp }}" id="telp" name="telp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" value="{{ $santri->email }}" id="email" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="pembiaya">Yang membiayai</label>
                                        <select id="pembiaya" name="pembiaya" class="form-control">
                                            <option value=""></option>
                                            <option {{ ($santri->pembiaya == 'Orang tua') ? 'selected' : '' }} value="Orang tua">Orang tua</option>
                                            <option {{ ($santri->pembiaya == 'Wali/Orang tua asuh') ? 'selected' : '' }} value="Wali/Orang tua asuh">Wali/Orang tua asuh</option>
                                            <option {{ ($santri->pembiaya == 'Tanggungan sendiri') ? 'selected' : '' }} value="Tanggungan sendiri">Tanggungan sendiri</option>
                                            <option {{ ($santri->pembiaya == 'Lainnya') ? 'selected' : '' }} value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                                        <select name="kebutuhan_khusus" id="kebutuhan_khusus" class="form-control">
                                            <option value=""></option>
                                            <option {{ ($santri->kebutuhan_khusus == 'Tidak ada') ? 'selected' : '' }} value="Tidak ada">Tidak ada</option>
                                            <option {{ ($santri->kebutuhan_khusus == 'Lamban belajar') ? 'selected' : '' }} value="Lamban belajar">Lamban belajar</option>
                                            <option {{ ($santri->kebutuhan_khusus == 'Kesulitan belajar spesifik') ? 'selected' : '' }} value="Kesulitan belajar spesifik">Kesulitan belajar spesifik</option>
                                            <option {{ ($santri->kebutuhan_khusus == 'Gangguan komunikasi') ? 'selected' : '' }} value="Gangguan komunikasi">Gangguan komunikasi</option>
                                            <option {{ ($santri->kebutuhan_khusus == 'Berbakat/Memiliki kemampuan dan kecerdasan luar biasa') ? 'selected' : '' }} value="Berbakat/Memiliki kemampuan dan kecerdasan luar biasa">Berbakat/Memiliki kemampuan dan kecerdasan luar biasa</option>
                                            <option {{ ($santri->kebutuhan_khusus == 'Lainnya') ? 'selected' : '' }} value="Lainnya">Lainnya</option>
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
                                            <option {{ ($santri->kebutuhan_disabilitas == 'Tidak ada') ? 'selected' : '' }} value="Tidak ada">Tidak ada</option>
                                            <option {{ ($santri->kebutuhan_disabilitas == 'Tuna netra') ? 'selected' : '' }} value="Tuna netra">Tuna netra</option>
                                            <option {{ ($santri->kebutuhan_disabilitas == 'Tuna rungu') ? 'selected' : '' }} value="Tuna rungu">Tuna rungu</option>
                                            <option {{ ($santri->kebutuhan_disabilitas == 'Tuna daksa') ? 'selected' : '' }} value="TUna daksa">TUna daksa</option>
                                            <option {{ ($santri->kebutuhan_disabilitas == 'Tuna grahita') ? 'selected' : '' }} value="Tuna grahita">Tuna grahita</option>
                                            <option {{ ($santri->kebutuhan_disabilitas == 'Tuna laras') ? 'selected' : '' }} value="Tuna laras">Tuna laras</option>
                                            <option {{ ($santri->kebutuhan_disabilitas == 'Lainnya') ? 'selected' : '' }} value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="gender">Gender Santri</label>
                                        <select value="" id="gender" name="gender" class="form-control" required>
                                            <option value="">-- Pilih Gender --</option>
                                            <option {{ ($santri->gender == 'male') ? 'selected' : '' }} value="male">Laki-laki</option>
                                            <option {{ ($santri->gender == 'female') ? 'selected' : '' }} value="female">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </section>

                        <h3>Data Orang Tua</h3>
                        <section class="p-2">

                            {{-- {{-- data ayah --}}
                            <div class=" row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nama_ayah">Nama Ayah</label>
                                        <input type="text" value="{{ $santri->nama_ayah }}" id="nama_ayah" name="nama_ayah" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="status_ayah">Status Ayah</label>
                                        <select name="status_ayah" id="status_ayah" name="status_ayah" class="form-control">
                                            <option value=""></option>
                                            <option {{ ($santri->status_ayah == 'Masih hidup' ? 'selected' : '') }} value="Masih hidup">Masih hidup</option>
                                            <option {{ ($santri->status_ayah == 'Sudah meninggal' ? 'selected' : '') }} value="Sudah meninggal">Sudah meninggal</option>
                                            <option {{ ($santri->status_ayah == 'Tidak diketahui' ? 'selected' : '') }} value="Tidak diketahui">Tidak diketahui</option>
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
                                            <option {{ ($santri->kewaraganegaraan_ayah == 'WNI') ? 'selected' : '' }} value="WNI">WNI</option>
                                            <option {{ ($santri->kewaraganegaraan_ayah == 'WNA') ? 'selected' : '' }} value="WNA">WNA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nik_ayah">NIK Ayah</label>
                                        <input value="{{ $santri->nik_ayah }}" type="text" id="nik_ayah" name="nik_ayah" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                                            <input value="{{ $santri->tempat_lahir_ayah }}" type="text" id="tempat_lahir_ayah" name="tempat_lahir_ayah" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                                            <input value="{{ $santri->tanggal_lahir_ayah }}" type="text" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="pendidikan_terakhir_ayah">Pendidikan Terakhir Ayah</label>
                                        <input value="{{ $santri->pendidikan_terakhir_ayah }}" type="text" id="pendidikan_terakhir_ayah" name="pendidikan_terakhir_ayah" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                        <input value="{{ $santri->pekerjaan_ayah }}" type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="penghasilan_ayah">Penghasilan Ayah</label>
                                        <select name="penghasilan_ayah" id="penghasilan_ayah" class="form-control">
                                            <option value=""></option>
                                            <option {{ ($santri->penghasilan_ayah == 'Kurang dari 500.000') ? 'selected' : '' }} value="Kurang dari 500.000">Kurang dari 500.000</option>
                                            <option {{ ($santri->penghasilan_ayah == '500.000 - 1.000.000') ? 'selected' : '' }} value="500.000 - 1.000.000">500.000 - 1.000.000</option>
                                            <option {{ ($santri->penghasilan_ayah == '1.000.000 - 2.000.000') ? 'selected' : '' }} value="1.000.000 - 2.000.000">1.000.000 - 2.000.000</option>
                                            <option {{ ($santri->penghasilan_ayah == '2.000.000 - 3.000.000') ? 'selected' : '' }} value="2.000.000 - 3.000.000">2.000.000 - 3.000.000</option>
                                            <option {{ ($santri->penghasilan_ayah == '3.000.000 - 5.000.000') ? 'selected' : '' }} value="3.000.000 - 5.000.000">3.000.000 - 5.000.000</option>
                                            <option {{ ($santri->penghasilan_ayah == '3.000.000 - 5.000.000') ? 'selected' : '' }} value="3.000.000 - 5.000.000">3.000.000 - 5.000.000</option>
                                            <option {{ ($santri->penghasilan_ayah == 'Lebih dari 5.000.000') ? 'selected' : '' }} value="Lebih dari 5.000.000">Lebih dari 5.000.000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="telp_ayah">No. Telp Ayah</label>
                                            <input value="{{ $santri->telp_ayah }}" type="text" id="telp_ayah" name="telp_ayah" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- data ibu --}}
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nama_ibu">Nama Ibu</label>
                                        <input type="text" value="{{ $santri->nama_ibu }}" id="nama_ibu" name="nama_ibu" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="status_ibu">Status Ibu</label>
                                        <select name="status_ibu" id="status_ibu" name="status_ibu" class="form-control">
                                            <option value=""></option>
                                            <option {{ ($santri->status_ibu == 'Masih hidup') ? 'selected' : '' }} value="Masih hidup">Masih hidup</option>
                                            <option {{ ($santri->status_ibu == 'Sudah meninggal') ? 'selected' : '' }} value="Sudah meninggal">Sudah meninggal</option>
                                            <option {{ ($santri->status_ibu == 'Tidak diketahui') ? 'selected' : '' }} value="Tidak diketahui">Tidak diketahui</option>
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
                                            <option {{ ($santri->kewaraganegaraan_ibu == 'WNI') ? 'selected' : '' }} value="WNI">WNI</option>
                                            <option {{ ($santri->kewaraganegaraan_ibu == 'WNA') ? 'selected' : '' }} value="WNA">WNA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="nik_ibu">NIK Ibu</label>
                                        <input value="{{ $santri->nik_ibu }}" type="text" id="nik_ibu" name="nik_ibu" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                                            <input value="{{ $santri->tempat_lahir_ibu }}" type="text" id="tempat_lahir_ibu" name="tempat_lahir_ibu" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                                            <input value="{{ $santri->tanggal_lahir_ibu }}" type="text" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="pendidikan_terakhir_ibu">Pendidikan Terakhir Ibu</label>
                                        <input value="{{ $santri->pendidikan_terakhir_ibu }}" type="text" id="pendidikan_terakhir_ibu" name="pendidikan_terakhir_ibu" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                        <input value="{{ $santri->pekerjaan_ibu }}" type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="penghasilan_ibu">Penghasilan Ibu</label>
                                        <select name="penghasilan_ibu" id="penghasilan_ibu" class="form-control">
                                            <option value=""></option>
                                            <option {{ ($santri->penghasilan_ibu == 'Kurang dari 500.000') ? 'selected' : '' }} value="Kurang dari 500.000">Kurang dari 500.000</option>
                                            <option {{ ($santri->penghasilan_ibu == '500.000 - 1.000.000') ? 'selected' : '' }} value="500.000 - 1.000.000">500.000 - 1.000.000</option>
                                            <option {{ ($santri->penghasilan_ibu == '1.000.000 - 2.000.000') ? 'selected' : '' }} value="1.000.000 - 2.000.000">1.000.000 - 2.000.000</option>
                                            <option {{ ($santri->penghasilan_ibu == '2.000.000 - 3.000.000') ? 'selected' : '' }} value="2.000.000 - 3.000.000">2.000.000 - 3.000.000</option>
                                            <option {{ ($santri->penghasilan_ibu == '3.000.000 - 5.000.000') ? 'selected' : '' }} value="3.000.000 - 5.000.000">3.000.000 - 5.000.000</option>
                                            <option {{ ($santri->penghasilan_ibu == '3.000.000 - 5.000.000') ? 'selected' : '' }} value="3.000.000 - 5.000.000">3.000.000 - 5.000.000</option>
                                            <option {{ ($santri->penghasilan_ibu == 'Lebih dari 5.000.000') ? 'selected' : '' }} value="Lebih dari 5.000.000">Lebih dari 5.000.000</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <label for="telp_ibu">No. Telp Ibu</label>
                                            <input value="{{ $santri->telp_ibu }}" type="text" id="telp_ibu" name="telp_ibu" class="form-control">
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
                                        <input type="text" value="{{ $santri->alamat }}" id="alamat" name="alamat" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-cm-12">
                                    <div class="mb-3">
                                        <label for="rt">RT</label>
                                        <input type="text" value="{{ $santri->rt }}" id="rt" name="rt" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-cm-12">
                                    <div class="mb-3">
                                        <label for="rw">RW</label>
                                        <input type="text" value="{{ $santri->rw }}" id="rw" name="rw" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-cm-12">
                                    <div class="mb-3">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type="text" value="{{ $santri->kelurahan }}" id="kelurahan" name="kelurahan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-cm-12">
                                    <div class="mb-3">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" value="{{ $santri->kode_pos }}" id="kode_pos" name="kode_pos" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="kabupaten">Kabupaten Santri</label>
                                        <input type="text" value="{{ $santri->kabupaten }}" id="kabupaten" name="kabupaten" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="provinsi">Provinsi Santri</label>
                                        <input type="text" value="{{ $santri->provinsi }}" id="provinsi" name="provinsi" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                        </section>

                        <h3>Riwayat</h3>
                        <section class="p-2">
                            <div class="row">
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tahun_masuk">Tahun Masuk</label>
                                        <input type="text" value="{{ $santri->tahun_masuk }}" id="tahun_masuk" name="tahun_masuk" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tahun_keluar">Tahun Keluar</label>
                                        <input type="text" value="{{ $santri->tahun_keluar }}" id="tahun_keluar" name="tahun_keluar" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mb-3">
                                        <label for="tahun_lulus">Tahun Lulus</label>
                                        <input type="text" value="{{ $santri->tahun_lulus }}" id="tahun_lulus" name="tahun_lulus" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="d-block"> Status Santri</label>
                                        <label class="switch s-primary mr-2">
                                            <input type="checkbox" {{ ($santri->is_active) ? 'checked' : '' }} class="activate ml-1" data-id="{{ $santri->id }}" data-nama="{{ $santri->nama }}">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary simpan-biodata" hidden>Simpan</button>
                    </div>

                </form>
            </div>


        </div>

    </x-card-box>

</div>
@endsection


@section('style')
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('cropperjs-main/dist/cropper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/forms/switches.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/jquery-step/jquery.steps.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cropperjs-main/dist/cropper.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-step/jquery.steps.min.js') }}"></script>
<x-sweet-alert />
<script>
    $(document).ready(function() {
        $("#tanggal_lahir").inputmask("99/99/9999")
        $("#tanggal_lahir_ayah").inputmask("99/99/9999")
        $("#tanggal_lahir_ibu").inputmask("99/99/9999")
    })
    const submitSimpanBiodataBtn = document.querySelector('button[type="submit"].simpan-biodata')
    submitSimpanBiodataBtn.addEventListener('click', () => {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        submitSimpanBiodataBtn.replaceChild(spinner, submitSimpanBiodataBtn.childNodes[0])
    })

    $(document).on('click', '.activate', function(e) {
        let is_checked = $(this).prop('checked')
        let id = $(this).attr('data-id')
        let nama = $(this).attr('data-nama')
        activateSantri(id, is_checked, nama)
    })

    $(document).on('click', 'a[href="#finish"]', function(e) {
        console.log('Finish clicked')
        $('form.form-biodata').submit()
        let finish = document.querySelector('a[href="#finish"]')
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        finish.replaceChild(spinner, finish.childNodes[0])
    })

    $('form.form-biodata').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()
        console.log(data)
        // serrialAssoc(data)
    })

    $("#circle-basic").steps({
        headerTag: "h3"
        , bodyTag: "section"
        , transitionEffect: "slideLeft"
        , autoFocus: true
        , cssClass: 'circle wizard'
    });

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        })
        prosesAjax(formData, "{{ route('edit-santri') }}")
    }

    function prosesAjax(data, route) {
        $.ajax({
            url: route, //
            method: 'POST', //
            data: data, //
            dataType: 'json', //
            processData: false, //
            contentType: false, //
            success: function(res) {
                feedback(res)
            }, //
            error: function(err) {
                console.log(err.responseText)
                errorClientSide(err.responseText)
            }
        });
    }

    function feedback(res) {
        if (!res.status) {
            const divError = document.createElement('div')
            for (let key in res.data) {
                res.data[key].forEach((e) => {
                    let span = document.createElement('span')
                    span.innerHTML = e + '<br>'
                    divError.appendChild(span)
                })
            }
            let data = {
                icon: 'error', //
                title: 'Oops!', //
                html: divError
            }
            sweetAlert(data)
            onfinish()
        } else {
            sweetAlert(res.data)
            onfinish()
        }
    }

    function errorClientSide(err) {
        let data = {
            icon: 'error', //
            title: 'Oops!', //
            html: err
        }
        sweetAlert(data)
        onfinish()
    }

    function onfinish() {
        let span = document.createElement('span')
        let finish = document.querySelector('a[href="#finish"]')
        span.innerHTML = 'Finish'
        // submitSimpanBiodataBtn.replaceChild(span, submitSimpanBiodataBtn.childNodes[0])
        finish.replaceChild(span, finish.childNodes[0])


    }

    // cropper
    const avatar = document.getElementById('previewImg')
    const cropper = new Cropper(avatar, {
        aspectRatio: 1, // Sesuaikan dengan rasio aspek yang Anda inginkan
        minContainerWidth: 350, // 
        minContainerHeight: 350, //
    })

    // Aktifkan pemilihan gambar saat file dipilih
    let inputImage = document.getElementById('avatar');
    inputImage.addEventListener('change', function() {
        $("#uploadImgModal").modal()
        let file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                cropper.replace(e.target.result);
            };
            reader.readAsDataURL(file);
        }
        // replaceBtn()
    });

    $('#uploadImgModal').on('hidden.bs.modal', () => {
        cropper.destroy()
        inputImage.value = ''
    })

    function upload() {

        cropper.getCroppedCanvas({
            width: 90, //
            height: 90, //
        });
        cropper.getCroppedCanvas().toBlob((blob) => {
            const formData = new FormData();

            // Pass the image file name as the third parameter if necessary.
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('id', '{{ $santri->id }}');
            formData.append('avatar', blob, '.png');

            // Use `jQuery.ajax` method for example
            $.ajax({
                url: "{{ route('foto-santri') }}", //
                method: 'POST', //
                data: formData, //
                processData: false, //
                contentType: false, //
                success: function(res) {
                    if (res.status) {
                        sweetAlert(res.data)
                        replaceImg(res.newImage)
                    } else {
                        sweetAlert(res.data)
                    }
                }, //
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        });
    }

    function replaceBtn() {
        const submitUploadBtnModal = document.querySelector('#uploadImgModal .modal-dialog .modal-content .modal-footer a')
        const newSubmitBtnModal = document.createElement('span')
        newSubmitBtnModal.id = 'crop'
        newSubmitBtnModal.innerText = 'Crop & Upload'
        submitUploadBtnModal.replaceChild(newSubmitBtnModal, submitUploadBtnModal.childNodes[0])

        runEvent()
    }

    replaceBtn()

    function replaceImg(newImageName) {
        console.log(newImageName);
        let src = "{{ route('get-foto', ['filename' => 'src_js']) }}".replace('src_js', newImageName)
        $('#foto').attr('src', src)
    }

    function runEvent() {
        $('#crop').parent().on('click', () => {
            $("#uploadImgModal").modal('hide')
            upload()
        })
    }

    function activateSantri(id, is_checked, nama) {

        let formData = new FormData
        formData.append('_token', "{{ csrf_token() }}")
        formData.append('id', id)
        formData.append('is_active', is_checked)
        formData.append('nama', nama)
        prosesAjax(formData, "{{ route('activate-santri') }}")
    }

    function progressProfile() {
        let formVal = $('form.form-biodata').serializeArray()
        let count = 0
        let lengthformVal = formVal.length
        formVal.forEach(element => {
            if (element.value != '') {
                count++
            }
        });
        const progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = Math.floor(count / lengthformVal * 100) + '%';
        progressBar.innerHTML = Math.floor(count / lengthformVal * 100) + '%';
    }

    progressProfile()

</script>


@endsection
