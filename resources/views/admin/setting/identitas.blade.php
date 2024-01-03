@extends('layout.main')
@section('title', 'Identitas')
@section('content')
<div class="row">

    <x-card-box cardTitle="Pengaturan Identitas Madin">

        <div class="form-row">
            <div class="col-lg-4 col-sm-12">
                <label>Logo Madin</label>
                <input type="file" accept="image/*" id="logo_madin" name="logo_madin" hidden>
                <div class="text-center">
                    <div class="avatar avatar-xl mb-4">
                        <img alt="logo" id="logo-image" src="{{ asset('storage/logo/' . $logo_madin) }}" width="250px" height="250px" class="rounded" />
                    </div>
                    <label for="logo_madin" class="btn btn-outline-primary btn-sm">Ubah logo</label>
                </div>

                <x-modal-box modalId="uploadImgModal" modalTitle="Upload Logo" modalUrl="#" modalSubmitText="Upload">
                    <div class="d-flex justify-content-center">
                        <img src="" id="previewImg" alt="preview">
                    </div>
                </x-modal-box>

            </div>

            <div class="col-lg-8 col-sm-12">
                <form method="POST" action="{{ route('simpan-setting-identitas') }}" class="form-identitas">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_madin">Nama Madin</label>
                        <input type="text" value="{{ $nama_madin }}" id="nama_madin" name="nama_madin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="alamat_madin">Alamat Madin</label>
                        <input type="text" value="{{ $alamat_madin }}" id="alamat_madin" name="alamat_madin" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="kota_madin">Kota Madin</label>
                                <input type="text" value="{{ $setting['kota_madin'] }}" id="kota_madin" name="kota_madin" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="kode_pos_madin">Kode Pos</label>
                                <input type="text" value="{{ $setting['kode_pos_madin'] }}" id="kode_pos_madin" name="kode_pos_madin" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="telp_madin">Telp Madin</label>
                                <input type="text" value="{{ $setting['telp_madin'] }}" id="telp_madin" name="telp_madin" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="email_madin">Email Madin</label>
                                <input type="text" value="{{ $setting['email_madin'] }}" id="email_madin" name="email_madin" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_statistik_madin">Nomor Statistik Madin</label>
                        <input type="text" value="{{ $setting['nomor_statistik_madin'] }}" id="nomor_statistik_madin" name="nomor_statistik_madin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nomo_notaris_madin">Nomor Notaris Madin</label>
                        <input type="text" value="{{ $setting['nomor_notaris_madin'] }}" id="nomor_notaris_madin" name="nomor_notaris_madin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nama_kepala_madin">Kepala Madin</label>
                        <input type="text" value="{{ $setting['nama_kepala_madin'] }}" id="nama_kepala_madin" name="nama_kepala_madin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nama_bendahara_madin">Bendahara Madin</label>
                        <input type="text" value="{{ $setting['nama_bendahara_madin'] }}" id="nama_bendahara_madin" name="nama_bendahara_madin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nama_sekretatis_madin">Sekretaris Madin</label>
                        <input type="text" value="{{ $setting['nama_sekretaris_madin'] }}" id="nama_sekretaris_madin" name="nama_sekretaris_madin" class="form-control">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="mb-3 btn btn-primary simpan-setting">Simpan</button>
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
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cropperjs-main/dist/cropper.min.js') }}"></script>
<x-sweet-alert />
<script>
    const submitSimpanSettingBtn = document.querySelector('button[type="submit"].simpan-setting')
    submitSimpanSettingBtn.addEventListener('click', () => {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        submitSimpanSettingBtn.replaceChild(spinner, submitSimpanSettingBtn.childNodes[0])
    })

    const avatar = document.getElementById('previewImg')
    const cropper = new Cropper(avatar, {
        aspectRatio: 1, // Sesuaikan dengan rasio aspek yang Anda inginkan
        minContainerWidth: 350, // 
        minContainerHeight: 350, //
    })

    // Aktifkan pemilihan gambar saat file dipilih
    let inputImage = document.getElementById('logo_madin');
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

    $('form.form-identitas').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()
        serrialAssoc(data)
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
            formData.append('logo_madin', blob, '.png');

            // Use `jQuery.ajax` method for example
            $.ajax({
                url: "{{ route('simpan-logo') }}", //
                method: 'POST', //
                data: formData, //
                processData: false, //
                contentType: false, //
                success: function(res) {
                    sweetAlert(res[0])
                    replaceImg(res[1])
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
        $('#logo-image').attr('src', "{{ asset('storage/logo') }}" + '/' + newImageName)
    }

    function runEvent() {
        $('#crop').parent().on('click', () => {
            $("#uploadImgModal").modal('hide')
            upload()
        })
    }

    function serrialAssoc(data) {
        let formData = new FormData()
        data.forEach(element => {
            formData.append(element.name, element.value)
        })
        prosesAjax(formData, "{{ route('simpan-setting-identitas') }}")
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
    }

    function onfinish() {
        let span = document.createElement('span')
        span.innerHTML = 'Simpan'
        submitSimpanSettingBtn.replaceChild(span, submitSimpanSettingBtn.childNodes[0])
    }

</script>

@endsection
