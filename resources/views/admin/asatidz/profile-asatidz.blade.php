@extends('layout.main')
@section('title', 'Detail Profile Asatidz')
@section('content')
<div class="row">

    <x-card-box cardTitle="Detail Profile Asatidz">


        <div class="form-row">

            <div class="col-lg-4 col-sm-12 mb-4">

                <a href="{{ route('data-asatidz') }}">
                    <div class="alert alert-outline-primary">
                        <span>&larr; Kembali ke Data Asatidz</span>
                    </div>
                </a>

                <label>Profile Asatidz</label>
                <input type="file" accept="image/*" id="avatar_asatidz" name="avatar_asatidz" hidden>
                <div class="text-center">
                    <div class="avatar avatar-xl mb-4">
                        <img alt="foto" id="foto" src="{{ route('get-foto', ['filename' => $data_asatidz->avatar]) }}" width="250px" height="250px" class="rounded bg-success" />
                    </div>
                    <label for="avatar_asatidz" class="btn btn-outline-primary btn-sm">Ubah foto</label>
                </div>

                <x-modal-box modalId="uploadImgModal" modalTitle="Upload foto" modalUrl="#" modalSubmitText="Upload">
                    <div class="d-flex justify-content-center">
                        <img src="" id="previewImg" alt="preview" height="450px">
                    </div>
                </x-modal-box>

            </div>


            <div class="col-lg-8 col-sm-12">
                <form method="POST" action="{{ route('edit-credential-asatidz') }}" class="mb-4">
                    @csrf

                    <input type="text" name="user_id" id="user_id" value="{{ $data_asatidz->user_id }}" hidden>

                    <div class="alert alert-light-warning">
                        <span>Data Pengguna <i>(Credential)</i></span>
                    </div>

                    <div class="mb-3">
                        <label for="nama_asatidz">Nama Asatidz</label>
                        <input type="text" value="{{ $data_asatidz->nama }}" id="nama_asatidz" name="nama" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email_asatidz">Email Asatidz</label>
                        <input type="text" value="{{ $data_asatidz->email }}" id="email_asatidz" name="email" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="gender_asatidz">Gender Asatidz</label>
                                <select id="gender_asatidz" name="gender" class="form-control">
                                    <option value="">-- Pilih Gender --</option>
                                    <option value="male" {{ ($data_asatidz->gender == 'male' ? 'selected' : '') }}>Laki-laki</option>
                                    <option value="female" {{ ($data_asatidz->gender == 'female' ? 'selected' : '') }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="role_asatidz">Role Asatidz</label>
                                <select id="role_asatidz" name="role" class="form-control">
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
                                <input type="password" value="" id="password_asatidz" name="password" class="form-control">
                                <span><i class="text-small text-warning">(*Kosongkan jika tidak ingin merubah password)</i></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="konfirmasi_password_asatidz">Konfirmasi Password Asatidz</label>
                                <input type="password" value="" id="konfirmasi_password_asatidz" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary simpan-credential">Simpan</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('edit-biodata-asatidz') }}">
                    @csrf

                    <input type="text" name="pengajar_id" id="pengajar_id" value="{{ $data_asatidz->pengajar_id }}" hidden>
                    <input type="text" name="nama" value="{{ $data_asatidz->nama }}" hidden>

                    <div class="alert alert-light-warning">
                        <span>Biodata Asatidz <i>(Data diri)</i></span>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="nik_asatidz">NIK Asatidz <i>(NIK 16 digit)</i></label>
                                <input type="text" value="{{ $data_asatidz->nik }}" id="nik_asatidz" name="nik" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="telp_asatidz">Telp Asatidz</label>
                                <input type="text" value="{{ $data_asatidz->telp }}" id="telp_asatidz" name="telp" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="tempat_lahir_asatidz">Tempat Lahir Asatidz</label>
                                <input type="text" value="{{ $data_asatidz->tempat_lahir }}" id="tempat_lahir_asatidz" name="tempat_lahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="tanggal_lahir_asatidz">Tanggal Lahir Asatidz <i>(dd/mm/yyyy)</i></label>
                                <input type="text" value="{{ $data_asatidz->tanggal_lahir }}" id="tanggal_lahir_asatidz" name="tanggal_lahir" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="pendidikan_terakhir_asatidz">Pendidikan Terkahir Asatidz <i>(Formal)</i></label>
                                <input type="text" value="{{ $data_asatidz->pendidikan_terakhir }}" id="pendidikan_terakhir_asatidz" name="pendidikan_terakhir" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="pendidikan_islam_asatidz">Pendidikan Islam Asatidz <i>(Pesantren)</i></label>
                                <input type="text" value="{{ $data_asatidz->pendidikan_islam }}" id="pendidikan_islam_asatidz" name="pendidikan_islam" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_asatidz">Alamat Asatidz <i>(Alamat lengkap)</i></label>
                        <input type="text" value="{{ $data_asatidz->alamat }}" id="alamat_asatidz" name="alamat" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="kabupaten_asatidz">Kabupaten Asatidz</label>
                                <input type="text" value="{{ $data_asatidz->kabupaten }}" id="kabupaten_asatidz" name="kabupaten" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="provinsi_asatidz">ProvinsiAsatidz</label>
                                <input type="text" value="{{ $data_asatidz->provinsi }}" id="provinsi_asatidz" name="provinsi" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary simpan-biodata">Simpan</button>
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
@endsection

@section('script')
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cropperjs-main/dist/cropper.min.js') }}"></script>
<x-sweet-alert />
<script>
    $("#tanggal_lahir_asatidz").inputmask("99/99/9999")
    const divError = document.createElement('div')

    const submitSimpanCredentialBtn = document.querySelector('button[type="submit"].simpan-credential')
    const submitSimpanBiodataBtn = document.querySelector('button[type="submit"].simpan-biodata')

    submitSimpanCredentialBtn.addEventListener('click', () => {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        submitSimpanCredentialBtn.replaceChild(spinner, submitSimpanCredentialBtn.childNodes[0])
    })
    submitSimpanBiodataBtn.addEventListener('click', () => {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        submitSimpanBiodataBtn.replaceChild(spinner, submitSimpanBiodataBtn.childNodes[0])
    })

    @error('email')
    const p1 = document.createElement('span')
    p1.innerHTML = '{{ $message }} <br>'
    divError.appendChild(p1)
    @enderror

    @error('password')
    const p2 = document.createElement('span')
    p2.innerHTML = '{{ $message }}'
    divError.appendChild(p2)
    @enderror

    if (divError.hasChildNodes()) {
        let data = {
            icon: 'error', //
            title: 'Oops!', //
            html: divError
        }
        sweetAlert(data)
    }

    @if(session('response'))
    let data = @json(session('response'));
    sweetAlert(data)
    @endif

    // cropper
    const avatar = document.getElementById('previewImg')
    const cropper = new Cropper(avatar, {
        aspectRatio: 1, // Sesuaikan dengan rasio aspek yang Anda inginkan
        minContainerWidth: 350, // 
        minContainerHeight: 350, //
    })

    // Aktifkan pemilihan gambar saat file dipilih
    let inputImage = document.getElementById('avatar_asatidz');
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
            formData.append('id', '{{ $data_asatidz->user_id }}');
            formData.append('avatar_asatidz', blob, '.png');

            // Use `jQuery.ajax` method for example
            $.ajax({
                url: "{{ route('foto-asatidz') }}", //
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

</script>
@endsection
