@extends('auth.layout.main')
@section('title', 'Login')

@section('content')
<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <div class="avatar avatar-xl">
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('storage/logo/' . $logo_madin) }}" alt="logo" class="rounded-circle" height="90px" width="90px">
                        </a>
                    </div>

                    <h3>{{ $nama_madin }}</h3>
                    <span>{{ $alamat_madin}}</span>

                    <form class="text-left" action="{{ route('login.auth') }}" method="POST">
                        <div class="form">
                            @csrf
                            <div id="username-field" class="field-wrapper input">
                                <label for="email">EMAIL</label>
                                <i data-feather="user"></i>
                                <input id="email" name="email" type="text" class="form-control" placeholder="cth: ustadz@madin.app" value="{{ old('email') }}">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">KATA SANDI</label>
                                    <a href="#" class="forgot-pass-link">Lupa kata sandi?</a>
                                </div>
                                <i data-feather="lock"></i>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Kata sandi">
                                <i data-feather="eye"></i>
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">Masuk</button>
                                </div>
                            </div>

                            {{-- <p class="signup-link">Belum terdaftar ? <a href="auth_register_boxed.html">Buat akun</a></p> --}}

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/sweetalerts/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/loaders/custom-loader.css') }}">
@endsection

@section('script')
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<x-sweet-alert />
<script>
    const divError = document.createElement('div')
    const submitBtn = document.querySelector('button[type="submit"]')

    submitBtn.addEventListener('click', () => {
        const spinner = document.createElement('div')
        spinner.classList = "spinner-border text-white align-self-center loader-sm"
        submitBtn.replaceChild(spinner, submitBtn.childNodes[0])
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

</script>




@endsection
