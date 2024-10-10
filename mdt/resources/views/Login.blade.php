<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.scss">
    @vite('resources/css/app.css')
    @vite('resources/css/login.scss')
    @vite('resources/js/app.js')
    <title>{{ $title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div id="container-login" class="container-login">
        <div class="logo-polda"> <img src="./svg/logoPolda.svg" alt=""></div>
        <div class="form-login">
            <h1>Sign in</h1>
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('account.authenticate') }}" method="POST">
                @csrf
                <input type="text" placeholder="Email / No telpon" value="{{ old('email') }}" name="email"
                    id="email">
                @error('email')
                    <p class="invalid-feedback"{{ $message }}></p>
                @enderror
                <input type="password" placeholder="Password" value="" name="password" id="password">
                @error('password')
                    <p class="invalid-feedback"{{ $message }}></p>
                @enderror
                <div class="dont-have-account" id="show-register">Tidak memiliki akun</div>
                <button type="submit" name="log in">Log in</button>
            </form>
        </div>
    </div>

    <div id="container-logout" class="container-logout" style="display: none">
        <div class="form-login">
            <h1>Sign Up</h1>
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{ route('account.register') }}" method="POST">
                @csrf
                <input type="text" placeholder="Nama Lengkap" value="{{ old('name') }}" name="name" id="name">
                <input type="text" placeholder="Nama Induk Kependudukan" value="{{ old('nik') }}" name="nik" id="nik">
                <input type="email" placeholder="Email" value="{{ old('email') }}" name="email" id="email">
                <input type="text" placeholder="No telpon/HP" value="{{ old('nomorhp') }}" name="nomorhp" id="nomorhp">
                <input type="password" placeholder="Password" value="" name="password" id="password">
                <input type="password" placeholder="Konfirmasi Password" value="" name="password_confirmation" id="password_confirmation">
                <div class="dont-have-account" id="show-login">Sudah Memiliki Akun</div>
                <button type="submit" name="sign up">Sign up</button>
            </form>
        </div>
        <div class="logo-tik"> <img src="./img/logoTik.png" alt=""></div>
    </div>

    <script>
        // Dapatkan elemen-elemen container login dan register
        const loginContainer = document.getElementById('container-login');
        const registerContainer = document.getElementById('container-logout');
        
        // Dapatkan elemen tombol yang mengubah tampilan
        const showRegisterBtn = document.getElementById('show-register');
        const showLoginBtn = document.getElementById('show-login');

        // Event untuk menampilkan form register
        showRegisterBtn.addEventListener('click', () => {
            loginContainer.style.display = 'none';
            registerContainer.style.display = 'flex';
        });

        // Event untuk menampilkan form login
        showLoginBtn.addEventListener('click', () => {
            loginContainer.style.display = 'flex';
            registerContainer.style.display = 'none';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>
