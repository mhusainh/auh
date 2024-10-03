<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $slot }}</title>
    <link rel="stylesheet" href="css/navbar.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/css/navbar.scss')
    @vite('resources/css/home.scss')
    @vite('resources/css/footer.scss')
    @vite('resources/css/laporan.scss')
    @vite('resources/css/laporan-orang.scss')
    @vite('resources/css/contact.scss')
    @vite('resources/css/profile.scss')
    @vite('resources/css/buat-laporan.scss')
    @vite('resources/css/edit-profile.scss')
    <style>
        @font-face {
            font-family: "Font Awesome 5 Free-Solid";
            src: url("https://anima-uploads.s3.amazonaws.com/5aa4ed775d7c3d000ce877fc/Font Awesome 5 Free-Solid-900.otf") format("opentype");
        }

        @font-face {
            font-family: "Font Awesome 6 Free-Solid";
            src: url("https://anima-uploads.s3.amazonaws.com/projects/6339b9b6cff130481da234b3/fonts/font-awesome-6-free-regular-400.otf") format("opentype");
        }

        @font-face {
            font-family: "Font Awesome 5 Free-Regular";
            src: url("https://anima-uploads.s3.amazonaws.com/5c465a4febb656000a872440/Font Awesome 5 Free-Regular-400.otf") format("opentype");
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>