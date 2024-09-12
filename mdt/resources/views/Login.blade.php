<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>

<body>
    <h1>Sign in</h1>

    <form action="{{ route('account.authenticate') }}" method="POST">
        @csrf
        <input type="text" placeholder="Email / No telpon" value="{{ old('email') }}" name="email" id="email">
        @error('email')
            <p class="invalid-feedback"{{ $message }}></p>
        @enderror
        <input type="password" placeholder="Password" value="" name="password" id="password">
        @error('password')
            <p class="invalid-feedback"{{ $message }}></p>
        @enderror
        <button type="submit" name="log in">Log in</button>
    </form>

    <h1>Sign up</h1>
    <form action="{{ route('account.register') }}" method="POST">
        @csrf
        <input type="text" placeholder="Nama Lengkap" value="{{ old('name') }}" name="name" id="name">
        <input type="text" placeholder="Nama Induk Kependudukan" value="{{ old('nik') }}" name="nik" id="nik">
        <input type="email" placeholder="email" value="{{ old('email') }}" name="email" id="email">
        <input type="text" placeholder="No telpon/HP" value="{{ old('nomorhp') }}" name="nomorhp" id="nomorhp">
        <input type="password" placeholder="Password" value="" name="password" id="password">
        <input type="password" placeholder="Konfirmasi Password" value="" name="password_confirmation" id="password_confirmation">
        <button type="submit" name="sign up">Sign up</button>
    </form>
</body>

</html>
