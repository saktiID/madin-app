@extends('layout.main')
@section('title', 'Detail Profile Asatidz')
@section('content')
<div class="row">

    <x-card-box cardTitle="Detail Profile Asatidz">


        <div class="form-row">

            <div class="col-lg-4 col-sm-12 mb-4">

                <div class="alert alert-outline-primary">
                    <a href="{{ route('data-asatidz') }}">
                        <span>&larr; Kembali ke Data Asatidz</span>
                    </a>
                </div>

                <label>Profile Asatidz</label>
                <input type="file" accept="image/*" id="avatar_asatidz" name="avatar_asatidz" hidden>
                <div class="text-center">
                    <div class="avatar avatar-xl mb-4">
                        <img alt="logo" id="logo-image" src="{{ asset($data_asatidz->avatar) }}" width="250px" height="250px" class="rounded" />
                    </div>
                    <label for="avatar_asatidz" class="btn btn-outline-primary btn-sm">Ubah logo</label>
                </div>

                <x-modal-box modalId="uploadImgModal" modalTitle="Upload Logo" modalUrl="#" modalSubmitText="Upload">
                    <div class="d-flex justify-content-center">
                        <img src="" id="previewImg" alt="preview">
                    </div>
                </x-modal-box>

            </div>


            <div class="col-lg-8 col-sm-12">
                <form method="POST" action="" class="mb-4">
                    @csrf

                    <div class="alert alert-light-warning">
                        <span>Data Pengguna <i>(Credential)</i></span>
                    </div>

                    <div class="mb-3">
                        <label for="nama_asatidz">Nama Asatidz</label>
                        <input type="text" value="{{ $data_asatidz->nama }}" id="nama_asatidz" name="nama_asatidz" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email_asatidz">Email Asatidz</label>
                        <input type="text" value="{{ $data_asatidz->email }}" id="email_asatidz" name="email_asatidz" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="gender_asatidz">Gender Asatidz</label>
                                <select id="gender_asatidz" name="gender_asatidz" class="form-control">
                                    <option value="">-- Pilih Gender --</option>
                                    <option value="male" {{ ($data_asatidz->gender == 'male' ? 'selected' : '') }}>Laki-laki</option>
                                    <option value="female" {{ ($data_asatidz->gender == 'female' ? 'selected' : '') }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="role_asatidz">Role Asatidz</label>
                                <select id="role_asatidz" name="role_asatidz" class="form-control">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Administrator" {{ ($data_asatidz->role == 'Administrator' ? 'selected' : '') }}>Administrator</option>
                                    <option value="Asatidz" {{ ($data_asatidz->role == 'Asatidz' ? 'selected' : '') }}>Asatidz</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="password_asatidz">Password Asatidz</label>
                                <input type="password" value="" id="password_asatidz" name="password_asatidz" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="konfirmasi_password_asatidz">Konfirmasi Password Asatidz</label>
                                <input type="password" value="" id="konfirmasi_password_asatidz" name="konfirmasi_password_asatidz" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary">Simpan</button>
                    </div>
                </form>

                <form method="POST" action="">
                    @csrf

                    <div class="alert alert-light-warning">
                        <span>Biodata Asatidz <i>(Data diri)</i></span>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="nik_asatidz">NIK Asatidz <i>(NIK 16 digit)</i></label>
                                <input type="text" value="{{ $data_asatidz->nik }}" id="nik_asatidz" name="nik_asatidz" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="telp_asatidz">Telp Asatidz</label>
                                <input type="text" value="{{ $data_asatidz->telp }}" id="telp_asatidz" name="telp_asatidz" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="tempat_lahir_asatidz">Tempat Lahir Asatidz</label>
                                <input type="text" value="{{ $data_asatidz->tempat_lahir }}" id="tempat_lahir_asatidz" name="tempat_lahir_asatidz" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="tanggal_lahir_asatidz">Tanggal Lahir Asatidz <i>(dd/mm/yyyy)</i></label>
                                <input type="text" value="{{ $data_asatidz->tanggal_lahir }}" id="tanggal_lahir_asatidz" name="tanggal_lahir_asatidz" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="pendidikan_terakhir_asatidz">Pendidikan Terkahir Asatidz <i>(Formal)</i></label>
                                <input type="text" value="{{ $data_asatidz->pendidikan_terakhir }}" id="pendidikan_terakhir_asatidz" name="pendidikan_terakhir_asatidz" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="pendidikan_islam_asatidz">Pendidikan Islam Asatidz <i>(Pesantren)</i></label>
                                <input type="text" value="{{ $data_asatidz->pendidikan_islam }}" id="pendidikan_islam_asatidz" name="pendidikan_islam_asatidz" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_asatidz">Alamat Asatidz <i>(Alamat lengkap)</i></label>
                        <input type="text" value="{{ $data_asatidz->alamat }}" id="alamat_asatidz" name="alamat_asatidz" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="kabupaten_asatidz">Kabupaten Asatidz</label>
                                <input type="text" value="{{ $data_asatidz->kabupaten }}" id="kabupaten_asatidz" name="kabupaten_asatidz" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="provinsi_asatidz">ProvinsiAsatidz</label>
                                <input type="text" value="{{ $data_asatidz->provinsi }}" id="provinsi_asatidz" name="provinsi_asatidz" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary">Simpan</button>
                    </div>

                </form>

            </div>

        </div>

    </x-card-box>

</div>
@endsection

@section('script')
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $("#tanggal_lahir_asatidz").inputmask("99/99/9999");

</script>
@endsection
