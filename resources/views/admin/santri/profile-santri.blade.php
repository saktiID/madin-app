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

            </div>


            <div class="col-lg-8 col-sm-12">
                <form method="POST" action="{{ route('edit-santri') }}" class="form-biodata mb-4">
                    @csrf

                    <input type="text" name="id" value="{{ $santri->id }}" hidden>

                    <div class="alert alert-light-warning">
                        <span>Biodata Santri <i>(Data diri)</i></span>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="nama">Nama Santri</label>
                                <input type="text" value="{{ $santri->nama }}" id="nama" name="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <label for="gender">Gender Santri</label>
                                <select value="" id="gender" name="gender" class="form-control" required>
                                    <option value="">-- Pilih Gender --</option>
                                    <option value="male" {{ ($santri->gender == 'male' ? 'selected' : '') }}>Laki-laki</option>
                                    <option value="female" {{ ($santri->gender == 'female' ? 'selected' : '') }}>Perempuan</option>
                                </select>
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


                    <div class="mb-3">
                        <label for="alamat">Alamat Santri <i>(Alamat lengkap)</i></label>
                        <input type="text" value="{{ $santri->alamat }}" id="alamat" name="alamat" class="form-control" required>
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
    $("#tanggal_lahir").inputmask("99/99/9999")
    const submitSimpanBiodataBtn = document.querySelector('button[type="submit"].simpan-biodata')
    submitSimpanBiodataBtn.addEventListener('click', () => {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        submitSimpanBiodataBtn.replaceChild(spinner, submitSimpanBiodataBtn.childNodes[0])
    })

    $('form.form-biodata').on('submit', function(e) {
        e.preventDefault()
        let data = $(this).serializeArray()
        serrialAssoc(data)
    })

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
    }

    function onfinish() {
        let span = document.createElement('span')
        span.innerHTML = 'Simpan'
        submitSimpanBiodataBtn.replaceChild(span, submitSimpanBiodataBtn.childNodes[0])
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

</script>


@endsection
